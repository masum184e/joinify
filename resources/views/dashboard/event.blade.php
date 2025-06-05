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
                    Presented by <span class="text-blue-600 font-semibold"> {{ $event->club->name }}</span>
                </p>
            </div>

            <!-- Edit Button -->
            @if(auth()->user() && auth()->user()->clubRoles->contains('role', 'secretary'))

                <a href="/dashboard/clubs/{{  $event->club->id }}/events/{{ $event->id }}/edit"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 5h10M11 9h7M11 13h4M4 6h.01M4 10h.01M4 14h.01M4 18h.01" />
                    </svg>
                    Edit Event
                </a>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Event Overview</h3>
                    <p class="mt-1 text-sm text-gray-500">Basic information about the event</p>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6">
        <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://placehold.co/400x200' }}"
            alt="{{ $event->title }}" class="w-full h-64 object-cover rounded-lg">
            </div>

            <div class="px-5 pb-5 grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">

                <div>
                    <dt class="text-sm font-medium text-gray-500">Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Time</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} -
                        {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Guest</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $event->guests->count() }}</dd>
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

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8 pb-4">
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
                                            <p class="text-sm text-gray-900">10:00 AM - <span class="font-medium">Meet at
                                                    the main entrance</span></p>
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
                                            <p class="text-sm text-gray-500">Brief introduction and photography tips for the
                                                day</p>
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
                                            <p class="text-sm text-gray-900">10:30 AM - <span class="font-medium">Begin
                                                    photo walk</span></p>
                                            <p class="text-sm text-gray-500">Explore the botanical gardens and capture
                                                photos</p>
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
                                            <p class="text-sm text-gray-900">11:45 AM - <span class="font-medium">Gather for
                                                    sharing</span></p>
                                            <p class="text-sm text-gray-500">Meet to share photos and get feedback</p>
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
                                            <p class="text-sm text-gray-900">12:00 PM - <span class="font-medium">Event
                                                    concludes</span></p>
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

@endsection