@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Club Advisor')
@section('layout-sub-title', 'Manage your club, track events, and oversee member activities.')

@section('content')
    <div class="mb-8 space-y-8">

        <!-- Event Title -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <!-- Title & Subtitle -->
            <div>
                <h1 class="text-4xl font-black text-gray-800 tracking-tight flex items-center gap-3">
                {{ $event->title }}
                </h1>
                <p class="text-sm text-gray-500 mt-1 italic">
                    Presented by <span class="text-blue-600 font-semibold">Coding Club</span>
                </p>
            </div>

            <!-- Edit Button -->
            <a href="/dashboard/events/0/edit"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5h10M11 9h7M11 13h4M4 6h.01M4 10h.01M4 14h.01M4 18h.01" />
                </svg>
                Edit Event
            </a>
        </div>

        <!-- Event Meta Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-800">
            <div class="flex items-start gap-3">
                <div class="text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Date</h3>
                    <p class="text-lg">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }} </p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Time</h3>
                    <p class="text-lg">{{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 12l4.243-4.243m0 0L12 13.414m5.657-5.657L12 2m0 0L6.343 6.343M12 2v20" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Location</h3>
                    <p class="text-lg">{{ $event->location }}</p>
                </div>
            </div>
        </div>

        <!-- Guests -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

            <!-- Guest Card 1 -->
            <div class="bg-gradient-to-br from-purple-100 to-purple-200 p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-bold text-purple-800 mb-1">Dr. Jane Smith</h3>
                <p class="text-sm text-purple-700">Keynote Speaker</p>
            </div>

            <!-- Guest Card 2 -->
            <div class="bg-gradient-to-br from-teal-100 to-teal-200 p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-bold text-teal-800 mb-1">Prof. Alan Turing</h3>
                <p class="text-sm text-teal-700">Guest Lecturer</p>
            </div>

            <!-- Guest Card 3 -->
            <div class="bg-gradient-to-br from-pink-100 to-pink-200 p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-bold text-pink-800 mb-1">Sarah Lee</h3>
                <p class="text-sm text-pink-700">Alumni</p>
            </div>

        </div>


        <!-- Description -->
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-2 flex items-center gap-2">📢 Description</h2>
            <p class="text-gray-700 leading-relaxed">
            {{ $event->description }}
            </p>
        </div>

    </div>

@endsection