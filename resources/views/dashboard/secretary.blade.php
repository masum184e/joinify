@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Secretary')

@section('layout-title', 'Club Secretary')
@section('layout-sub-title', 'Manage your club, track events, and oversee member activities.')

@section('content')

    <div class="max-w-7xl mx-auto mb-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Total Events -->
            <div class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 rounded-2xl shadow-lg border-l-4 border-blue-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-blue-700 uppercase">Total Events</h2>
                        <p class="text-3xl font-extrabold text-blue-900 mt-1">{{ $totalEvents }}</p>
                    </div>
                    <div class="bg-blue-500 text-white rounded-full p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3M5 11h14M5 19h14M5 15h14M5 7h14" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div
                class="bg-gradient-to-br from-green-100 to-green-200 p-6 rounded-2xl shadow-lg border-l-4 border-green-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-green-700 uppercase">Upcoming Events</h2>
                        <p class="text-3xl font-extrabold text-green-900 mt-1">{{ $upcomingEvents }}</p>
                    </div>
                    <div class="bg-green-500 text-white rounded-full p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Guests -->
            <div
                class="bg-gradient-to-br from-purple-100 to-purple-200 p-6 rounded-2xl shadow-lg border-l-4 border-purple-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-purple-700 uppercase">Total Guests</h2>
                        <p class="text-3xl font-extrabold text-purple-900 mt-1">{{ $totalGuests }}</p>
                    </div>
                    <div class="bg-purple-500 text-white rounded-full p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 110 8 4 4 0 010-8zM8 7a4 4 0 100 8 4 4 0 000-8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Events -->
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <div
                class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-blue-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3M3 11h18M5 20h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z" />
                    </svg>
                    Recent Events
                </h2>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <ul class="divide-y divide-gray-100">
                <!-- Event 1 -->
                @foreach ($recentEvents as $event)
                    <li class="px-6 py-4 hover:bg-gray-50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-start gap-3">
                                <div class="bg-green-100 text-green-600 p-2 rounded-full">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 7a4 4 0 01-8 0m8 0V3a1 1 0 00-1-1h-6a1 1 0 00-1 1v4m8 0H8m8 0a4 4 0 010 8m0 0v4m0-4H8" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $event->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                            <a href="/dashboard/clubs/{{ $clubId }}/events/0"
                                class="text-blue-600 text-sm font-medium hover:underline flex items-center gap-1">
                                View
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </li>
                @endforeach
                <!-- Add more event items as needed -->
            </ul>
        </div>

    </div>

@endsection