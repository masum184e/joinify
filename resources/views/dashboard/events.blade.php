@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Student Advisor')
@section('layout-sub-title', 'Manage your club\'s events and members efficiently.')

@section('content')
    <div class="max-w-7xl mx-auto mb-8">
        <!-- Search & Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between pb-4 gap-4 pt-2">

            <!-- Create Event Button -->
            @if(auth()->user() && auth()->user()->clubRoles->contains('role', 'secretary'))
                <a href="/dashboard/clubs/{{ $clubId }}/events/create"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition duration-300">
                    Create New Event
                </a>
            @endif

            <!-- Search Box -->
            <div class="relative w-full md:w-64">
                <input type="text" id="eventSearch" placeholder="Search event..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
                <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 pointer-events-none" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </div>

        </div>

        <!-- Events List -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Upcoming Events</h2>
                <div class="flex space-x-2">
                    <button type="button"
                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i class="ri-calendar-line mr-1"></i>
                        Calendar View
                    </button>
                    <button type="button"
                        class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-md text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i class="ri-list-check mr-1"></i>
                        List View
                    </button>
                </div>
            </div>

            <ul class="divide-y divide-gray-200">
                @foreach($events as $event)
                    <li class="hover:bg-gray-50">
                        <div class="flex items-center justify-between px-4 py-4 sm:px-6">
                            <a href="/dashboard/clubs/{{ $clubId }}/events/{{ $event->id }}" class="flex-1 flex items-center">
                                <div
                                    class="flex-shrink-0 h-20 w-20 bg-accent-100 text-blue-600 rounded-lg flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-sm font-medium">
                                            {{ \Carbon\Carbon::parse($event->date)->format('M') }}
                                        </div>
                                        <div class="text-xl font-bold">
                                            {{ \Carbon\Carbon::parse($event->date)->format('d') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1 px-4">
                                    <p class="text-sm font-medium text-blue-600 truncate">{{ $event->title }}</p>
                                    <p class="mt-1 flex items-center text-sm text-gray-500">
                                        <i class="ri-time-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                        <span class="truncate">
                                            {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} -
                                            {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                                        </span>
                                    </p>
                                    <p class="mt-1 flex items-center text-sm text-gray-500">
                                        <i class="ri-map-pin-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                        <span class="truncate">{{ $event->location }}</span>
                                    </p>
                                    <p class="mt-1 flex items-center text-sm text-gray-500">
                                        <i class="ri-megaphone-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                        <span class="truncate">Total Guest: {{ $event->guests->count() }}</span>
                                    </p>
                                </div>
                            </a>
                            <div class="ml-5 flex-shrink-0 flex flex-col items-end space-y-2">
                                <a href="/dashboard/clubs/{{ $clubId }}/events/{{ $event->id }}/edit"
                                    class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-indigo-100 hover:bg-indigo-200 transition"
                                    title="Edit Event">
                                    <i class="ri-pencil-line"></i>
                                </a>
                                <form method="POST" action="{{ url('/dashboard/clubs/' . $clubId . '/events/' . $event->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button title="Delete Event" type="submit"
                                        onclick="return confirm('Are you sure you want to delete this event?')"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-100 hover:bg-red-200 transition">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>


    </div>

@endsection