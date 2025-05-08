<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Guest;
use App\Models\EventGuest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function publicIndex()
    {
        $events = Event::select('id', 'title', 'start_time', 'end_time', 'date', 'location')
            ->with('guests')
            ->get();

        return view('events', compact('events'));
    }

    public function publicShow($eventId)
    {
        $event = Event::with(['guests', 'club'])->findOrFail($eventId);
        return view('event', compact('event'));
    }

    public function publicIndexForClub($clubId)
    {
        $events = Event::select('id', 'title', 'start_time', 'end_time', 'date', 'location')
            ->where('club_id', $clubId)
            ->with('guests')
            ->get();

        return view('club-events', compact('events'));
    }

    public function publicShowForClub($clubId, $eventId)
    {
        $event = Event::with(['guests', 'club'])
            ->where('club_id', $clubId)
            ->findOrFail($eventId);
        return view('event', compact('event'));
    }

    public function index($clubId)
    {
        $isSecretaryOrPresident = auth()->user()->clubRoles()
            ->whereIn('role', ['secretary', 'president'])
            ->exists();

        if (!$isSecretaryOrPresident) {
            abort(403, 'Unauthorized action.');
        }

        if (auth()->user()->clubRoles()->first()->club_id != $clubId) {
            abort(404, 'Club not found');
        }

        $events = Event::select('id', 'title', 'start_time', 'end_time', 'date', 'location')
            ->where('club_id', $clubId)
            ->with('guests')
            ->get();

        return view('dashboard.events', compact('events', 'clubId'));
    }

    public function show($clubId, $eventId)
    {
        $isSecretaryOrPresident = auth()->user()->clubRoles()
            ->whereIn('role', ['secretary', 'president'])
            ->exists();

        if (!$isSecretaryOrPresident) {
            abort(403, 'Unauthorized action.');
        }

        $event = Event::with(['guests', 'club'])->findOrFail($eventId);
        return view('dashboard.event', compact('event'));
    }

    public function create($clubId)
    {
        $isSecretary = auth()->user()->clubRoles()->where('role', 'secretary')->exists();

        if (!$isSecretary) {
            abort(403, 'Unauthorized action.');
        }

        $page = 'create';
        return view('dashboard.event-form', compact('page', 'clubId'));
    }

    public function edit($clubId, $eventId)
    {
        $isSecretary = auth()->user()->clubRoles()->where('role', 'secretary')->exists();

        if (!$isSecretary) {
            abort(403, 'Unauthorized action.');
        }

        $event = Event::with('guests')->findOrFail($eventId);
        $page = 'edit';
        return view('dashboard.event-form', compact('page', 'event', 'clubId'));
    }
    public function destroy($clubId, $eventId)
    {
        $isSecretary = auth()->user()->clubRoles()->where('role', 'secretary')->exists();

        if (!$isSecretary) {
            abort(403, 'Unauthorized action.');
        }

        $event = Event::findOrFail($eventId);
        $event->delete();

        return redirect('/dashboard/clubs/' . $clubId . '/events')->with('success', 'Event deleted successfully.');
    }
    public function store(Request $request)
    {
        $isSecretary = auth()->user()->clubRoles()->where('role', 'secretary')->exists();

        if (!$isSecretary) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'guests' => 'array',
            'guests.*.name' => 'required|string|max:255',
            'guests.*.email' => 'nullable|email|max:255',
            'poster' => 'required|image|max:2048', // 2MB max
        ]);

        $path = null;

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $clubRole = auth()->user()->clubRoles()->first();
            if (!$clubRole) {
                return redirect()->back()->with('error', 'You are not associated with any club.');
            }
            // fetch it from isSecretary
            // $clubRole = auth()->user()->clubRoles()->first();
            // if (!$clubRole) {
            //     return redirect()->back()->with('error', 'You are not associated with any club.');
            // }

            if ($request->hasFile('poster')) {
                $path = $request->file('poster')->store('posters', 'public');
            }

            $event = Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'date' => $request->date,
                'poster' => $path,
                'location' => $request->location,
                'club_id' => $clubRole->club_id

            ]);

            if ($request->has('guests')) {
                foreach ($request->guests as $guestData) {
                    $guest = Guest::firstOrCreate(
                        ['email' => $guestData['email']],
                        ['name' => $guestData['name']]
                    );

                    EventGuest::create([
                        'event_id' => $event->id,
                        'guest_id' => $guest->id,
                    ]);
                }
            }

            DB::commit();

            return redirect('/dashboard/clubs/' . $clubRole->club_id . '/events')->with('success', 'Event created successfully.');


        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Event creation failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            ;

            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->back()
                ->with('error', 'An error occurred')
                ->withInput();
        }
    }

    public function update(Request $request, $clubId, $eventId)
    {
        $isSecretary = auth()->user()->clubRoles()->where('role', 'secretary')->exists();

        if (!$isSecretary) {
            abort(403, 'Unauthorized action.');
        }

        $rules = [];

        if ($request->filled('title')) {
            $rules['title'] = 'string|max:255';
        }

        if ($request->filled('description')) {
            $rules['description'] = 'string|max:2000';
        }

        if ($request->filled('start_time')) {
            $rules['start_time'] = 'date_format:H:i';
        }

        if ($request->filled('end_time')) {
            $rules['end_time'] = 'date_format:H:i';
        }

        if ($request->filled('date')) {
            $rules['date'] = 'date';
        }

        if ($request->filled('location')) {
            $rules['location'] = 'string|max:255';
        }

        if ($request->filled('guests')) {
            $rules['guests'] = 'array';
            $rules['guests.*.name'] = 'required|string|max:255';
            $rules['guests.*.email'] = 'nullable|email|max:255';
        }

        if ($request->hasFile('poster')) {
            $rules['poster'] = 'image|max:2048';
        }

        if ($request->hasFile('banner')) {
            $rules['banner'] = 'image|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $event = Event::where('club_id', $clubId)->findOrFail($eventId);

            // Handle file uploads
            if ($request->hasFile('poster')) {
                if ($event->poster && Storage::disk('public')->exists($event->poster)) {
                    Storage::disk('public')->delete($event->poster);
                }
                $event->poster = $request->file('poster')->store('posters', 'public');
            }

            // Update fillable fields only
            $event->fill($request->only(['title', 'description', 'start_time', 'end_time', 'date', 'location']));
            $event->save();

            // Update guests (if provided)
            if ($request->filled('guests')) {
                $event->guests()->delete();

                foreach ($request->guests as $guestData) {
                    $guest = !empty($guestData['email'])
                        ? Guest::firstOrCreate(['email' => $guestData['email']], ['name' => $guestData['name']])
                        : Guest::create(['name' => $guestData['name'], 'email' => null]);

                    EventGuest::create([
                        'event_id' => $event->id,
                        'guest_id' => $guest->id,
                    ]);
                }
            }

            DB::commit();

            return redirect("/dashboard/clubs/{$clubId}/events/{$event->id}")->with('success', 'Event updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Event update failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while updating the event.')
                ->withInput();
        }
    }
}
