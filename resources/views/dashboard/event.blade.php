@extends('dashboard.includes.layout')

@section('title', $event->title)
@section('sub-title', 'Joinify')

@section('layout-title', $event->title)
@section('layout-sub-title', 'Manage event details, attendees, and settings')

@section('content')
    <div class="mb-8">
        <!-- Breadcrumb and Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4 pt-2 sm:mb-0">
                <a href="{{ route('events.index', $club->id) }}" class="hover:text-gray-700">{{ $club->name }}</a>
                <i class="ri-arrow-right-s-line"></i>
                <span class="text-gray-900 font-medium">{{ $event->title }}</span>
            </div>

            <div class="flex items-center space-x-3 mt-1">
                @if($isEditable && (auth()->user() && auth()->user()->clubRoles->contains('role', 'secretary')))
                    <a href="{{ route('events.edit', [$club->id, $event->id]) }}"
                        class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="ri-edit-line mr-2"></i>
                        Edit Event
                    </a>
                @endif

            </div>
        </div>

        <!-- Event Status Banner -->
        @if($stats['is_today'])
            <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-6">
                <div class="flex items-center">
                    <i class="ri-calendar-check-line text-green-400 mr-3"></i>
                    <div>
                        <h3 class="text-sm font-medium text-green-800">Event is happening today!</h3>
                        <p class="text-sm text-green-700">Make sure everything is ready for your attendees.</p>
                    </div>
                </div>
            </div>
        @elseif($stats['is_past'])
            <div class="bg-gray-50 border border-gray-200 rounded-md p-4 mb-6">
                <div class="flex items-center">
                    <i class="ri-history-line text-gray-400 mr-3"></i>
                    <div>
                        <h3 class="text-sm font-medium text-gray-800">This event has ended</h3>
                        <p class="text-sm text-gray-600">Event took place {{ abs($stats['days_until']) }}
                            {{ abs($stats['days_until']) == 1 ? 'day' : 'days' }} ago.</p>
                    </div>
                </div>
            </div>
        @elseif($stats['is_upcoming'])
            <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
                <div class="flex items-center">
                    <i class="ri-time-line text-blue-400 mr-3"></i>
                    <div>
                        <h3 class="text-sm font-medium text-blue-800">Upcoming Event</h3>
                        <p class="text-sm text-blue-700">
                            {{ abs($stats['days_until']) }} {{ abs($stats['days_until']) == 1 ? 'day' : 'days' }} remaining
                            until the event.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Event Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Event Header -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Event Overview</h3>
                            <p class="mt-1 text-sm text-gray-500">Basic information about the event</p>
                        </div>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $club->name }}
                        </span>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://placehold.co/400x200' }}"
                            alt="{{ $event->title }}" class="w-full h-64 object-cover rounded-lg">
                    </div>

                    <div class="px-5 pb-5 grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Time</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} -
                                {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Location</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $event->location }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Price</dt>
                            <dd class="mt-1 text-sm text-gray-900">Free</dd>
                        </div>

                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $event->description }}</dd>
                        </div>
                    </div>

                </div>

                <!-- Guest Management -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900">Guest Information</h2>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Guest</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($event->guests as $guest)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $guest->user ? $guest->user->name : $guest->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600">
                                                {{ $guest->user ? $guest->user->email : $guest->email }}
                                            </div>
                                            @if($guest->phone)
                                                <div class="text-sm text-gray-500">{{ $guest->email }}</div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                            <i class="ri-user-line text-4xl mb-2"></i>
                                            <p>No guests registered yet</p>
                                            <button onclick="openAddGuestModal()"
                                                class="mt-2 text-blue-600 hover:text-blue-800 font-medium">
                                                Add the first guest
                                            </button>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Event Schedule -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden pb-8">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Event Schedule</h3>
                        <p class="mt-1 text-sm text-gray-500">Timeline and activities for the event</p>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                            aria-hidden="true"></span>
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span
                                                    class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center ring-8 ring-white">
                                                    <i class="ri-calendar-check-line text-primary-600"></i>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-900">10:00 AM - <span
                                                            class="font-medium">Meet at the main entrance</span></p>
                                                    <p class="text-sm text-gray-500">Welcome and introduction</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                            aria-hidden="true"></span>
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span
                                                    class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center ring-8 ring-white">
                                                    <i class="ri-camera-line text-primary-600"></i>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-900">10:15 AM - <span
                                                            class="font-medium">Photography tips</span></p>
                                                    <p class="text-sm text-gray-500">Brief introduction and photography tips
                                                        for the day</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                            aria-hidden="true"></span>
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span
                                                    class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center ring-8 ring-white">
                                                    <i class="ri-footprint-line text-primary-600"></i>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-900">10:30 AM - <span
                                                            class="font-medium">Begin photo walk</span></p>
                                                    <p class="text-sm text-gray-500">Explore the botanical gardens and
                                                        capture photos</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                            aria-hidden="true"></span>
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span
                                                    class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center ring-8 ring-white">
                                                    <i class="ri-group-line text-primary-600"></i>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-900">11:45 AM - <span
                                                            class="font-medium">Gather for sharing</span></p>
                                                    <p class="text-sm text-gray-500">Meet to share photos and get feedback
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="relative">
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span
                                                    class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center ring-8 ring-white">
                                                    <i class="ri-flag-line text-primary-600"></i>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-900">12:00 PM - <span
                                                            class="font-medium">Event concludes</span></p>
                                                    <p class="text-sm text-gray-500">Wrap-up and final announcements</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Event Statistics -->
                <!-- Event Stats -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Event Stats</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 ">
                        <dd class="mt-1">
                            <div class="text-sm text-gray-900">
                                <div class="flex items-center justify-between mb-1">
                                    <span>Total Guests</span>
                                    <span class="font-medium">{{ $stats['total_guests'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Duration</span>
                                    <span class="font-medium">{{ $stats['duration_hours'] }}h</span>
                                </div>
                            </div>
                        </dd>
                    </div>
                </div>

                <!-- Event Details -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Event Details</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 h-10 w-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="ri-calendar-line"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Date</p>
                                    <p class="text-sm text-gray-600">
                                        {{ Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 h-10 w-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="ri-time-line"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Time</p>
                                    <p class="text-sm text-gray-600">
                                        {{ Carbon\Carbon::parse($event->start_time)->format('g:i A') }} -
                                        {{ Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 h-10 w-10 bg-red-100 text-red-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Location</p>
                                    <p class="text-sm text-gray-600">{{ $event->location }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 h-10 w-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="ri-group-line"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Organized by</p>
                                    <p class="text-sm text-gray-600">{{ $event->club->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Events -->
                @if($relatedEvents->count() > 0)
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Other Events</h3>
                            <div class="space-y-3">
                                @foreach($relatedEvents as $relatedEvent)
                                    <a href="{{ route('events.show', [$club->id, $relatedEvent->id]) }}"
                                        class="block p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <h4 class="text-sm font-medium text-gray-900 mb-1">{{ $relatedEvent->title }}</h4>
                                        <p class="text-xs text-gray-500">
                                            {{ Carbon\Carbon::parse($relatedEvent->date)->format('M j, Y') }}</p>
                                    </a>
                                @endforeach
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('events.index', $club->id) }}"
                                    class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                    View All Events
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection