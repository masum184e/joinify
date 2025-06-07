@extends('dashboard.includes.layout')

@section('title', 'Event Management')
@section('sub-title', $club->name)

@section('layout-title', 'Event Management')
@section('layout-sub-title', 'Manage and organize club events')

@section('content')
<div class="mb-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center justify-between pb-2">
                <h3 class="text-sm font-medium text-gray-600">Total Events</h3>
                <i class="ri-calendar-line text-gray-400"></i>
            </div>
            <div class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</div>
            <div class="text-xs text-gray-500">All time</div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center justify-between pb-2">
                <h3 class="text-sm font-medium text-gray-600">Upcoming</h3>
                <i class="ri-time-line text-blue-400"></i>
            </div>
            <div class="text-2xl font-bold text-blue-600">{{ $stats['upcoming'] }}</div>
            <div class="text-xs text-gray-500">Future events</div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center justify-between pb-2">
                <h3 class="text-sm font-medium text-gray-600">Past Events</h3>
                <i class="ri-history-line text-gray-400"></i>
            </div>
            <div class="text-2xl font-bold text-gray-600">{{ $stats['past'] }}</div>
            <div class="text-xs text-gray-500">Completed</div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center justify-between pb-2">
                <h3 class="text-sm font-medium text-gray-600">Today</h3>
                <i class="ri-calendar-check-line text-green-400"></i>
            </div>
            <div class="text-2xl font-bold text-green-600">{{ $stats['today'] }}</div>
            <div class="text-xs text-gray-500">Events today</div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center justify-between pb-2">
                <h3 class="text-sm font-medium text-gray-600">Total Guests</h3>
                <i class="ri-user-line text-purple-400"></i>
            </div>
            <div class="text-2xl font-bold text-purple-600">{{ $stats['total_guests'] }}</div>
            <div class="text-xs text-gray-500">All events</div>
        </div>
    </div>

    <!-- Filters and Actions -->
    <div class="bg-white rounded-lg border border-gray-200 mb-6">
        <div class="p-6 ">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">{{ $club->name }} Events</h3>
                    <p class="text-sm text-gray-500">Manage your club events and track attendance</p>
                </div>
                @if(auth()->user() && auth()->user()->clubRoles->contains('role', 'secretary'))
                <a href="{{ route('events.create', $club->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="ri-add-circle-line mr-2"></i>
                    Create Event
                </a>
                @endif
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="p-6">
            <form method="GET" action="{{ route('events.index', $club->id) }}" class="flex flex-col sm:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" name="search" value="{{ $search }}" 
                               placeholder="Search events by title, description, or location..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-search-line text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Filter Dropdown -->
                <div class="sm:w-48">
                    <select name="filter" 
                            class="w-full px-3 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>All Events</option>
                        <option value="upcoming" {{ $filter == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="past" {{ $filter == 'past' ? 'selected' : '' }}>Past Events</option>
                        <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Today</option>
                    </select>
                </div>

                <!-- Search Button -->
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="ri-search-line mr-2"></i>
                    Search
                </button>

                @if($search || $filter != 'all')
                    <a href="{{ route('events.index', $club->id) }}" 
                       class="px-4 py-2 bg-blue-300 text-gray-700 text-sm font-medium rounded-md hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 flex items-center">
                        Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Events Grid -->
    @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($events as $event)
                @php
                    $eventDate = \Carbon\Carbon::parse($event->date);
                    $today = \Carbon\Carbon::today();
                    $isPast = $eventDate->lt($today);
                    $isToday = $eventDate->isToday();
                    $isUpcoming = $eventDate->gt($today);
                @endphp
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="relative">
                        <!-- Event Image Placeholder -->
                        <div class="w-full h-48 ">
                                        <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://placehold.co/400x200' }}"
            alt="{{ $event->title }}" class="absolute inset-0 w-full h-48 object-cover rounded-t-lg">
                            <div class="absolute bottom-0 left-0 pr-8 m-4 text-white w-full">
                                <div class="flex justify-between items-end">
                                    <h4 class="font-semibold text-lg text-blue-600">{{ $event->title }}</h4>
                                    <div class="flex flex-col items-end space-y-2">
                                        @if(auth()->user() && auth()->user()->clubRoles->contains('role', 'secretary'))
                                        <a href="/dashboard/clubs/{{ $club->id }}/events/{{ $event->id }}/edit"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-indigo-600 hover:bg-indigo-200 hover:text-indigo-600 transition"
                                            title="Edit Event">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                        <form method="POST" action="{{ url('/dashboard/clubs/' . $club->id . '/events/' . $event->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Delete Event" type="submit"
                                                onclick="return confirm('Are you sure you want to delete this event?')"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-600 hover:bg-red-200 hover:text-red-600 transition">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Date Badge -->
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                            <span class="block text-sm font-semibold text-gray-900">{{ $eventDate->format('M') }}</span>
                            <span class="block text-xl font-bold {{ $isPast ? 'text-gray-600' : 'text-blue-600' }}">{{ $eventDate->format('d') }}</span>
                        </div>
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            @if($isToday)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Today
                                </span>
                            @elseif($isPast)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Completed
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $eventDate->diffForHumans() }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-time-line mr-1.5"></i>
                            <span>{{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</span>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-calendar-line mr-1.5"></i>
                            <span>{{ $eventDate->format('l, F j, Y') }}</span>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-map-pin-line mr-1.5"></i>
                            <span>{{ $event->location }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="ri-user-line mr-1.5"></i>
                                <span>{{ $event->guests->count() }} guests</span>
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('events.show', [$club->id, $event->id]) }}" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                                    View Details
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
            <div class="flex justify-center">
                {{ $events->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
            <div class="text-center py-12">
                <i class="ri-calendar-line text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                    @if($search)
                        No events found matching "{{ $search }}"
                    @elseif($filter == 'upcoming')
                        No upcoming events
                    @elseif($filter == 'past')
                        No past events
                    @elseif($filter == 'today')
                        No events scheduled for today
                    @else
                        No events found
                    @endif
                </h3>
                <p class="text-gray-500 mb-6">
                    @if($search || $filter != 'all')
                        Try adjusting your search or filter criteria.
                    @else
                        Get started by creating your first event for {{ $club->name }}.
                    @endif
                </p>
                @if(!$search && $filter == 'all')
                    <a href="{{ route('events.create', $club->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="ri-add-line mr-2"></i>
                        Create Your First Event
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>

@if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg z-50" id="success-message">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 3000);
    </script>
@endif
@endsection