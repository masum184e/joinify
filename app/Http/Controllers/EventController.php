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

class EventController extends Controller
{
    public function publicIndex($clubId)
    {
        $events = Event::select('id', 'title', 'start_time', 'end_time', 'date', 'location')
            ->where('club_id', $clubId)
            ->with('guests')
            ->get();

        return view('events', compact('events'));
    }

    public function publicShow($clubId, $eventId)
    {
        $event = Event::with(['guests', 'club'])->findOrFail($eventId);
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
            'description' => 'nullable|string|max:2000',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'guests' => 'array',
            'guests.*.name' => 'required|string|max:255',
            'guests.*.email' => 'nullable|email|max:255',
        ]);

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

            $event = Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'date' => $request->date,
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

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'guests' => 'array',
            'guests.*.name' => 'required|string|max:255',
            'guests.*.email' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $event = Event::findOrFail($eventId);
            $event->update([
                'title' => $request->title,
                'description' => $request->description,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'date' => $request->date,
                'location' => $request->location,
            ]);

            // Delete existing event guests (pivot records only)
            $event->guests()->delete();

            // Re-add guests
            if ($request->has('guests')) {
                foreach ($request->guests as $guestData) {
                    // Find or create guest
                    if (!empty($guestData['email'])) {
                        $guest = Guest::firstOrCreate(
                            ['email' => $guestData['email']],
                            ['name' => $guestData['name']]
                        );
                    } else {
                        $guest = Guest::create([
                            'name' => $guestData['name'],
                            'email' => null,
                        ]);
                    }

                    // Create a new EventGuest entry
                    EventGuest::create([
                        'event_id' => $event->id,
                        'guest_id' => $guest->id,
                    ]);
                }
            }

            DB::commit();

            return redirect('/dashboard/clubs/' . $clubId . '/events')->with('success', 'Event updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Event update failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);
            return redirect()->back()
                ->with('error', 'An error occurred')
                ->withInput();
        }
    }
}
