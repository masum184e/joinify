@extends('dashboard.includes.layout')

@section('title', 'Secretary Dashboard')
@section('sub-title', $club->name)

@section('layout-title', 'Secretary Dashboard')
@section('layout-sub-title', 'Event management and scheduling overview')

@section('content')

    <div class="mb-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg border border-border p-4 shadow-sm">
                <div class="flex items-center justify-between pb-2">
                    <h3 class="text-sm font-medium">Total Events</h3>
                    <i class="ri-calendar-line text-gray-500"></i>
                </div>
                <div class="text-2xl font-bold">{{ $totalEvents }}</div>
                <div class="text-xs text-gray-500">All time</div>
            </div>

            <div class="bg-white rounded-lg border border-border p-4 shadow-sm">
                <div class="flex items-center justify-between pb-2">
                    <h3 class="text-sm font-medium">Upcoming Events</h3>
                    <i class="ri-time-line text-gray-500"></i>
                </div>
                <div class="text-2xl font-bold">{{ $upcomingEvents->count() }}</div>
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

        <!-- Upcoming Events -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-lg border border-border shadow-sm">
                <div class="p-4 border-b border-border">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="ri-calendar-line mr-2 "></i>
                            <h3 class="font-medium">Upcoming Events</h3>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500">Events scheduled in the next 30 days</p>
                </div>
                <div class="p-4">
                    <div class="space-y-6">
                        @forelse ($upcomingEvents as $event)
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
                                        <i class="ri-time-line mr-2 "></i>
                                        {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }} •
                                        {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="ri-map-pin-line mr-2 "></i>
                                        {{ $event->location }}
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="ri-user-line mr-2 "></i>
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

            <!-- Recent Events -->
            <div class="bg-white rounded-lg border border-border shadow-sm">
                <div class="p-4 border-b border-border">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="ri-calendar-line mr-2 "></i>
                            <h3 class="font-medium">Recent Events</h3>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500">Past events and attendance records</p>
                </div>
                <div class="p-4">
                    <div class="space-y-6">
                        @forelse ($recentEvents as $event)
                            <div class="border-b pb-4 last:border-0">
                                <a href="/dashboard/clubs/{{ $club->id }}/events/{{ $event->id }}"
                                    class="block hover:bg-gray-50 -mx-2 px-2 py-1 rounded-md transition-colors">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-medium">{{ $event->title }}</h3>
                                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded-full">
                                            {{ Carbon\Carbon::parse($event->date)->diffForHumans() }}
                                        </span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 mb-1">
                                        <i class="ri-calendar-line mr-2 "></i>
                                        {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="ri-user-line mr-2 "></i>
                                        {{ $event->guests->count() }} guests
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-6 text-gray-500">
                                <i class="ri-history-line text-4xl mb-2"></i>
                                <p>No past events found</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Calendar and Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-lg border border-border shadow-sm">
                <div class="p-4 border-b border-border">
                    <div class="flex items-center justify-between">
                        <h3 class="font-medium">Event Calendar</h3>
                        <div class="flex gap-2">
                            <a href="#"
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-600 h-8 w-8 p-0">
                                <i class="ri-arrow-left-s-line"></i>
                            </a>
                            <span class="text-sm inline-flex items-center justify-center">{{ $monthName }}</span>
                            <a href="#"
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-600 h-8 w-8 p-0">
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-7 gap-1 text-center text-xs font-medium text-gray-500 mb-2">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="grid grid-cols-7 gap-1 text-sm">
                        @php
                            $dayCount = 1;
                            $daysInPrevMonth = $firstDayOfMonth->copy()->subMonth()->endOfMonth()->day;
                        @endphp

                        {{-- Previous month days --}}
                        @for ($i = 0; $i < $startDayOfWeek; $i++)
                            <div class="aspect-square p-1 text-gray-400">
                                {{ $daysInPrevMonth - $startDayOfWeek + $i + 1 }}
                            </div>
                        @endfor

                        {{-- Current month days --}}
                        @for ($i = 1; $i <= $daysInMonth; $i++)
                            @php
                                $currentDate = $firstDayOfMonth->copy()->addDays($i - 1)->format('Y-m-d');
                                $hasEvents = isset($calendarEvents[$currentDate]) && $calendarEvents[$currentDate] > 0;
                                $isToday = $currentDate == Carbon\Carbon::today()->format('Y-m-d');
                            @endphp

                            <div class="aspect-square p-1 relative group">
                                <div class="{{ $hasEvents ? 'bg-blue-600 text-white' : ($isToday ? 'bg-gray-200' : '') }} 
                                                    {{ $hasEvents || $isToday ? 'rounded-md font-medium' : '' }} 
                                                    w-full h-full flex items-center justify-center">
                                    {{ $i }}

                                    @if ($hasEvents)
                                        <span class="absolute bottom-1 right-1 w-1.5 h-1.5 bg-white rounded-full"></span>
                                    @endif
                                </div>

                                @if ($hasEvents)
                                    <div class="absolute z-10 bg-white border border-gray-200 rounded-md shadow-lg p-2 w-48 
                                                            hidden group-hover:block top-full left-1/2 transform -translate-x-1/2">
                                        <p class="text-xs font-medium text-gray-700 mb-1">
                                            {{ Carbon\Carbon::parse($currentDate)->format('F j, Y') }}</p>
                                        <p class="text-xs text-blue-600">{{ $calendarEvents[$currentDate] }} event(s) scheduled</p>
                                    </div>
                                @endif
                            </div>
                        @endfor

                        {{-- Next month days --}}
                        @php
                            $remainingDays = 42 - ($startDayOfWeek + $daysInMonth); // 42 = 6 rows * 7 days
                        @endphp

                        @for ($i = 1; $i <= $remainingDays; $i++)
                            <div class="aspect-square p-1 text-gray-400 w-full h-full flex items-center justify-center">{{ $i }}</div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-border shadow-sm">
                <div class="p-4 border-b border-border">
                    <h3 class="font-medium">Quick Actions</h3>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        <a href="/dashboard/clubs/{{ $club->id }}/events/create"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-blue-600 text-white hover:bg-blue-700 h-10 px-4 py-2 w-full">
                            <i class="ri-add-line mr-2"></i>
                            Create New Event
                        </a>
                        <a href="/dashboard/clubs/{{ $club->id }}/events"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input  hover:text-blue-600 h-10 px-4 py-2 w-full">
                            <i class="ri-calendar-line mr-2"></i>
                            View All Events
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection