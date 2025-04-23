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
            <a href="/dashboard/clubs/{{ $clubId }}/events/create"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition duration-300">
                Create New Event
            </a>

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
        <!-- Event Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($events as $event)
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-6 space-y-3">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $event->title }}
                    </h2>
                    <div class="flex items-center text-sm text-gray-600 gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                    </div>
                    <div class="text-sm text-gray-700">🕙 {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} –
                        {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</div>
                    <div class="text-sm text-gray-700">📍 Location: {{ $event->location }}</div>
                    <div class="text-sm text-gray-700">👥 Guests: {{ $event->guests->count() }}</div>

                    <div class="flex justify-between items-center pt-4">
                        <a href="/dashboard/clubs/{{ $clubId }}/events/{{ $event->id }}" title="View Details"
                            class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-100 hover:bg-blue-200 transition">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M2 8C2 7.44772 2.44772 7 3 7H21C21.5523 7 22 7.44772 22 8C22 8.55228 21.5523 9 21 9H3C2.44772 9 2 8.55228 2 8Z"
                                        fill="#2563eb" />
                                    <path
                                        d="M2 12C2 11.4477 2.44772 11 3 11H21C21.5523 11 22 11.4477 22 12C22 12.5523 21.5523 13 21 13H3C2.44772 13 2 12.5523 2 12Z"
                                        fill="#2563eb" />
                                    <path
                                        d="M3 15C2.44772 15 2 15.4477 2 16C2 16.5523 2.44772 17 3 17H15C15.5523 17 16 16.5523 16 16C16 15.4477 15.5523 15 15 15H3Z"
                                        fill="#2563eb" />
                                </g>
                            </svg>
                        </a>
                        <div class="flex gap-3">
                            <a href="/dashboard/clubs/{{ $clubId }}/events/{{ $event->id }}/edit"
                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-indigo-100 hover:bg-indigo-200 transition"
                                title="Edit Club">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536M9 11l-1 4 4-1 7.071-7.071a2 2 0 00-2.828-2.828L9 11z" />
                                </svg>
                            </a>

                            <!-- Remove Icon -->
                            <button title="Remove Club"
                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-100 hover:bg-red-200 transition">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

@endsection