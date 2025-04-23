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
    public function index($id)
    {
        $clubId = $id;
        $events = Event::select('id', 'title', 'start_time', 'end_time', 'date', 'location')
            ->where('club_id', $clubId)
            ->with('guests')
            ->get();

        return view('dashboard.events', compact('events', 'clubId'));
    }

    public function create($id)
    {
        $page = 'create';
        $clubId = $id;
        return view('dashboard.event-form', compact('page', 'clubId'));
    }

    public function store(Request $request)
    {
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
                foreach ($request->guests as $guest) {
                    Guest::create([
                        'event_id' => $event->id,
                        'name' => $guest['name'],
                        'email' => $guest['email'] ?? null,
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
}
