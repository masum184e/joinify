@extends('dashboard.includes.layout')

@section('title', 'President Dashboard')
@section('sub-title', $club->name)

@section('layout-title', 'President Dashboard')
@section('layout-sub-title', 'Overview of club members, events, and activities')

@section('content')

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg border border-border p-4 shadow-sm">
    <div class="flex items-center justify-between pb-2">
      <h3 class="text-sm font-medium">Total Members</h3>
      <i class="ri-user-line text-gray-500"></i>
    </div>
    <div class="text-2xl font-bold">{{ $totalMembers }}</div>
    <div class="text-xs text-gray-500">
      <span class="text-green-600">{{ $activeMembers }}</span> active members
    </div>
    </div>

    <div class="bg-white rounded-lg border border-border p-4 shadow-sm">
    <div class="flex items-center justify-between pb-2">
      <h3 class="text-sm font-medium">Total Events</h3>
      <i class="ri-calendar-line text-gray-500"></i>
    </div>
    <div class="text-2xl font-bold">{{ $totalEvents }}</div>
    <div class="text-xs text-gray-500">Organized all time</div>
    </div>

    <div class="bg-white rounded-lg border border-border p-4 shadow-sm">
    <div class="flex items-center justify-between pb-2">
      <h3 class="text-sm font-medium">Upcoming Events</h3>
      <i class="ri-time-line text-gray-500"></i>
    </div>
    <div class="text-2xl font-bold">{{ $upcomingEvents }}</div>
    <div class="text-xs text-gray-500">Next 30 days</div>
    </div>

    <div class="bg-white rounded-lg border border-border p-4 shadow-sm">
    <div class="flex items-center justify-between pb-2">
      <h3 class="text-sm font-medium">Total Guests</h3>
      <i class="ri-user-line text-gray-500"></i>
    </div>
    <div class="text-2xl font-bold">{{ $totalGuests }}</div>
    <div class="text-xs text-gray-500">Event attendees</div>
    </div>
  </div>

  <!-- Activity and Events -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg border border-border shadow-sm">
    <div class="p-4 border-b border-border">
      <div class="flex items-center justify-between">
      <div class="flex items-center">
        <i class="ri-shake-hands-line mr-2 "></i>
        <h3 class="font-medium">Recent Activities</h3>
      </div>
      </div>
      <p class="text-sm text-gray-500">Latest club activities and updates</p>
    </div>
    <div class="p-4">
      <div class="space-y-4">
      @forelse ($activities as $activity)
      <div class="border-b pb-3 last:border-0">
      <div class="flex justify-between items-start mb-2">
      <p class="text-sm font-medium leading-none">{{ $activity['type'] }}</p>
      <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}</p>
      </div>
      <p class="text-xs text-gray-500 mt-1">{{ $activity['description'] }}</p>
      </div>
    @empty
      <div class="text-center py-6 text-gray-500">
      <i class="ri-information-line text-4xl mb-2"></i>
      <p>No recent activities found</p>
      </div>
    @endforelse
      </div>
    </div>
    </div>

    <div class="bg-white rounded-lg border border-border shadow-sm">
    <div class="p-4 border-b border-border">
      <div class="flex items-center justify-between">
      <div class="flex items-center">
        <i class="ri-calendar-line mr-2 "></i>
        <h3 class="font-medium">Upcoming Events</h3>
      </div>
      <a href="/dashboard/clubs/{{ $club->id }}/events" class="text-sm text-blue-600 hover:text-blue-800">View all</a>
      </div>
      <p class="text-sm text-gray-500">Events scheduled in the next 30 days</p>
    </div>
    <div class="p-4">
      <div class="space-y-6">
      @forelse ($upcomingEventsList as $event)
      <div class="border-b pb-4 last:border-0">
      <a href="/dashboard/clubs/{{ $club->id }}/events/{{ $event->id }}"
      class="block hover:bg-gray-50 -mx-2 px-2 py-1 rounded-md transition-colors">
      <div class="flex justify-between items-start mb-2">
        <h3 class="font-medium">{{ $event->title }}</h3>
        <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
        {{ Carbon\Carbon::parse($event->date)->diffForHumans() }}
        </span>
      </div>
      <div class="flex items-center text-sm text-gray-500 mb-1">
        <i class="ri-time-line mr-2 h-4 w-4"></i>
        {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }} •
        {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
      </div>
      <div class="flex items-center text-sm text-gray-500">
        <i class="ri-map-pin-line mr-2 h-4 w-4"></i>
        {{ $event->location }}
      </div>
      <div class="flex items-center text-sm text-gray-500 mt-1">
        <i class="ri-user-line mr-2 h-4 w-4"></i>
        {{ $event->guests->count() }} guests
      </div>
      </a>
      </div>
    @empty
      <div class="text-center py-6 text-gray-500">
      <i class="ri-calendar-line text-4xl mb-2"></i>
      <p>No upcoming events in the next 30 days</p>
      <a href="/dashboard/clubs/{{ $club->id }}/events/create"
      class="mt-2 inline-block text-sm text-blue-600 hover:text-blue-800">
      Create an event
      </a>
      </div>
    @endforelse
      </div>
    </div>
    </div>
  </div>


@endsection