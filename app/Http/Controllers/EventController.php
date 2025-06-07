<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Guest;
use App\Models\Club;
use App\Models\EventGuest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventController extends Controller
{
    public function publicIndex()
    {
        $today = Carbon::today();

        $upcomingEvents = Event::with('club')
            ->where('date', '>=', $today)
            ->get();

        $pastEvents = Event::with('club')
            ->where('date', '<', $today)
            ->get();
        $club = "";

        return view('events', compact('upcomingEvents', 'pastEvents', 'club'));

    }

    public function publicShow($eventId)
    {
        $event = Event::with(['guests', 'club'])->findOrFail($eventId);
        return view('event', compact('event'));
    }

    public function publicIndexForClub($clubId)
    {
        $club = Club::findOrFail($clubId);
        $today = Carbon::today();
        $upcomingEvents = $club->events->where('date', '>=', $today);
        $pastEvents = $club->events->where('date', '<', $today);

        return view('events', compact('upcomingEvents', 'pastEvents', 'club'));
    }

  public function publicShowForClub($clubId, $eventId)
    {
        $event = Event::with([
            'guests', 
            'club.president', 
            'club.secretary',
            'club.accountant'
        ])
        ->where('club_id', $clubId)
        ->findOrFail($eventId);

        // Get similar events from the same club
        $similarEvents = Event::where('club_id', $clubId)
            ->where('id', '!=', $eventId)
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->limit(3)
            ->get();


        return view('event', compact(
            'event', 
            'similarEvents', 
        ));
    }

    public function index(Request $request, $clubId)
    {
        $isSecretaryOrPresident = auth()->user()->clubRoles()
            ->whereIn('role', ['secretary', 'president'])
            ->where('club_id', $clubId)
            ->exists();

        if (!$isSecretaryOrPresident) {
            abort(403, 'Unauthorized action.');
        }

        // Get the club information
        $club = Club::findOrFail($clubId);

        // Get filter parameters
        $filter = $request->get('filter', 'all'); // all, upcoming, past
        $search = $request->get('search');

        // Build the query
        $eventsQuery = Event::where('club_id', $club->id)
            ->with(['guests'])
            ->select('id', 'title', 'description', 'poster', 'start_time', 'end_time', 'date', 'location', 'created_at');

        // Apply filters
        $today = Carbon::today();

        switch ($filter) {
            case 'upcoming':
                $eventsQuery->where('date', '>=', $today);
                break;
            case 'past':
                $eventsQuery->where('date', '<', $today);
                break;
            case 'today':
                $eventsQuery->whereDate('date', $today);
                break;
        }

        // Apply search
        if ($search) {
            $eventsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Order by date
        $events = $eventsQuery->orderBy('date', 'desc')->paginate(12)->appends($request->query());

        // Get statistics
        $stats = $this->getEventStats($club->id);

        return view('dashboard.events', compact('events', 'club', 'filter', 'search', 'stats'));
    }

    private function getEventStats($clubId)
    {
        $today = Carbon::today();

        $totalEvents = Event::where('club_id', $clubId)->count();

        $upcomingEvents = Event::where('club_id', $clubId)
            ->where('date', '>=', $today)
            ->count();

        $pastEvents = Event::where('club_id', $clubId)
            ->where('date', '<', $today)
            ->count();

        $todayEvents = Event::where('club_id', $clubId)
            ->whereDate('date', $today)
            ->count();

        $totalGuests = Event::where('club_id', $clubId)
            ->withCount('guests')
            ->get()
            ->sum('guests_count');

        return [
            'total' => $totalEvents,
            'upcoming' => $upcomingEvents,
            'past' => $pastEvents,
            'today' => $todayEvents,
            'total_guests' => $totalGuests
        ];
    }
    public function show($clubId, $eventId)
    {
        $isSecretaryOrPresident = auth()->user()->clubRoles()
            ->whereIn('role', ['secretary', 'president'])
            ->where('club_id', $clubId)
            ->exists();

        if (!$isSecretaryOrPresident) {
            abort(403, 'Unauthorized action.');
        }

        // Get the club information
        $club = Club::findOrFail($clubId);
        if (auth()->user()->clubRoles()->first()->club_id != $clubId) {
            abort(404, 'Club not found');
        }
        $event = Event::where('club_id', $club->id)
            ->with(['guests', 'club'])
            ->findOrFail($eventId);

        // Get event statistics
        $stats = $this->getEventStatistics($event);

        // Get similar/related events from the same club
        $relatedEvents = Event::where('club_id', $club->id)
            ->where('id', '!=', $eventId)
            ->orderBy('date', 'desc')
            ->take(3)
            ->get();

        // Check if event is editable (future events only)
        $isEditable = Carbon::parse($event->date)->isFuture();

        return view('dashboard.event', compact(
            'event',
            'club',
            'stats',
            'relatedEvents',
            'isEditable'
        ));
    }

    private function getEventStatistics($event)
    {
        $eventDate = Carbon::parse($event->date);
        $today = Carbon::today();

        return [
            'total_guests' => $event->guests->count(),
            'confirmed_guests' => $event->guests->where('status', 'confirmed')->count(),
            'pending_guests' => $event->guests->where('status', 'pending')->count(),
            'is_past' => $eventDate->isPast(),
            'is_today' => $eventDate->isToday(),
            'is_upcoming' => $eventDate->isFuture(),
            'days_until' => $eventDate->diffInDays($today, false),
            'duration_hours' => Carbon::parse($event->start_time)->diffInHours(Carbon::parse($event->end_time))
        ];
    }

    public function create($clubId)
    {
        $isSecretary = auth()->user()->clubRoles()->where('role', 'secretary')->exists();

        if (!$isSecretary) {
            abort(403, 'Unauthorized action.');
        }

        $club = Club::findOrFail($clubId);
        $page = 'create';

        return view('dashboard.event-form', compact('page', 'club'));
    }

    public function edit($clubId, $eventId)
    {
        $isSecretary = auth()->user()->clubRoles()->where('role', 'secretary')->exists();

        if (!$isSecretary) {
            abort(403, 'Unauthorized action.');
        }

        if (auth()->user()->clubRoles()->first()->club_id != $clubId) {
            abort(404, 'Club not found');
        }

        $event = Event::with('guests')->findOrFail($eventId);
        $club = Club::findOrFail($clubId);

        $page = 'edit';
        return view('dashboard.event-form', compact('page', 'event', 'club'));
    }
    public function destroy($clubId, $eventId)
    {
        $isSecretary = auth()->user()->clubRoles()->where('role', 'secretary')->exists();

        if (!$isSecretary) {
            abort(403, 'Unauthorized action.');
        }

        if (auth()->user()->clubRoles()->first()->club_id != $clubId) {
            abort(404, 'Club not found');
        }

        $event = Event::findOrFail($eventId);
        $event->delete();

        return redirect('/dashboard/clubs/' . $clubId . '/events')->with('success', 'Event deleted successfully.');
    }
    public function store(Request $request, $clubId)
    {
        $isSecretary = auth()->user()->clubRoles()->where('role', 'secretary')->exists();

        if (!$isSecretary) {
            abort(403, 'Unauthorized action.');
        }

        if (auth()->user()->clubRoles()->first()->club_id != $clubId) {
            abort(404, 'Club not found');
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

        if (auth()->user()->clubRoles()->first()->club_id != $clubId) {
            abort(404, 'Club not found');
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
