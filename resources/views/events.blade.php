@extends('includes.layout')

@section('title', 'Events')
@section('sub-title', $club ? $club->name : 'Browse Events')

@section('content')

    <!-- Upcoming Events -->
    <section class="pt-28 pb-8">
        @if($club)
            <h1 class='text-4xl font-bold text-gray-900 text-center font-poppins mb-8'>{{ $club->name }} Events</h1>
        @endif

        @if($upcomingEvents->count() > 0)

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 font-poppins mb-8">Upcoming Events</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($upcomingEvents as $event)
                        @php
                            $eventDate = \Carbon\Carbon::parse($event->date);
                            $today = \Carbon\Carbon::today();
                            $isPast = $eventDate->lt($today);
                            $isToday = $eventDate->isToday();
                            $isUpcoming = $eventDate->gt($today);
                        @endphp
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <div class="relative">
                                <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://placehold.co/400x200' }}"
                                    alt="{{ $event->title }}" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                                    <span class="block text-sm font-semibold text-gray-900">{{ $eventDate->format('M') }}</span>
                                    <span
                                        class="block text-xl font-bold {{ $isPast ? 'text-gray-600' : 'text-blue-600' }}">{{ $eventDate->format('d') }}</span>

                                </div>
                                <div class="absolute top-4 right-4">

                                    @if ($event->club)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $event->club->name }}
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="ri-time-line mr-1.5"></i>
                                    <span> {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} -
                                        {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="ri-map-pin-line mr-1.5"></i>
                                    <span>{{ $event->location }}</span>
                                </div>
                                <div class="flex items-center justify-end">
                                    <a href="/clubs/{{ $event->club_id }}/events/{{ $event->id }}"
                                        class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                        View Details
                                        <i class="ri-arrow-right-line ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        @endif
    </section>

    @if($upcomingEvents->count() > 0)

        <!-- Past Events -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 font-poppins mb-8">Past Events</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($pastEvents as $event)

                        <!-- Past Event Card 1 -->
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <div class="relative">
                                <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://placehold.co/400x200' }}"
                                    alt="{{ $event->title }}" class=" w-full h-48 object-cover rounded-t-lg">
                                <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                                    <span class="block text-sm font-semibold text-gray-900">{{ $eventDate->format('M') }}</span>
                                    <span
                                        class="block text-xl font-bold {{ $isPast ? 'text-gray-600' : 'text-blue-600' }}">{{ $eventDate->format('d') }}</span>
                                </div>
                                <div class="absolute top-4 right-4">
                                    @if ($event->club)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $event->club->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="ri-time-line mr-1.5"></i>
                                    <span> {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} -
                                        {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</span>

                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="ri-map-pin-line mr-1.5"></i>
                                    <span>{{ $event->location }}</span>
                                </div>
                                <div class="flex items-center justify-end">
                                    <a href="/clubs/{{ $event->club_id }}/events/{{ $event->id }}"
                                        class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                        View Details
                                        <i class="ri-arrow-right-line ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </section>
    @endif

@endsection