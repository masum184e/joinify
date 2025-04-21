<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
    {
        // Fetch all events with their guests
        $events = Event::with('guests')->get();

        // Return to the dashboard view
        return view('dashboard.events', compact('events'));
    }

    public function show($id)
    {
        // Fetch a single event with guests
        $event = Event::with('guests')->findOrFail($id);

        // Return to the single event view
        return view('dashboard.event', compact('event'));
    }

    public function public_show($id)
    {
        // Fetch a single event with guests
        $event = Event::with('guests')->findOrFail($id);

        // Return to the single event view
        return view('event', compact('event'));
    }

    public function store(Request $request)
    {
        // Validate event data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'start_time' => 'required',
            'end_time' => 'required',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'guests' => 'array',
            'guests.*.name' => 'required_with:guests.*.email|string|max:255',
            'guests.*.email' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        DB::beginTransaction();

        try {
            // Create the event
            $event = Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'date' => $request->date,
                'location' => $request->location,
                'club_id' =>auth()->user()->clubRoles()->first()?->club_id
            ]);

            // Create guest entries
            if ($request->has('guests')) {
                foreach ($request->guests as $guest) {
                    Guest::create([
                        'event_id' => $event->id,
                        'name' => $guest['name'],
                        'email' => $guest['email'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Event created successfully.',
                'redirect' => '/dashboard/events'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Event creation failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error while creating event.'
            ]);
        }
    }
}
