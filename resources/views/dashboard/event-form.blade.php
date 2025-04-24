@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Secretary')

@section('layout-title', 'Club Secretary')
@section('layout-sub-title', 'Manage your club, track events, and oversee member activities.')

@section('content')
    <div
        class="w-full max-w-3xl p-10 bg-gradient-to-br from-white via-blue-50 to-blue-100 rounded-2xl shadow-xl mx-auto mb-8">
        <h2
            class="text-3xl font-extrabold text-center mb-8 text-blue-800 tracking-tight flex items-center justify-center gap-2">
            @if($page === 'create')
                🎉 Create New Event
            @else
                <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Update Event Details
            @endif
        </h2>


        <!-- Event Creation Form -->
        <form id="clubForm" method="POST"
            action="{{ $page === 'create' ? '/dashboard/clubs/' . $clubId . '/events' : '/dashboard/clubs/' . $clubId . '/events/' . $event->id }}"
            class="space-y-6">
            @csrf
            @if($page === 'edit')
                @method('PUT')
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- Event Title -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Event Title</label>
                <input type="text" placeholder="e.g. Tech Talk 2025" name="title" value="{{ $event->title ?? '' }}"
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white" />
                @error('title')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea rows="4" placeholder="Describe the event..." name="description"
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white">{{ $event->description ?? '' }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date & Time -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Start Time</label>
                    <input type="time" name="start_time" value="{{ $event->start_time ?? '' }}"
                        class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white" />
                    @error('start_time')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">End Time</label>
                    <input type="time" name="end_time" value="{{ $event->end_time ?? '' }}"
                        class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white" />
                    @error('end_time')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Event Date</label>
                <input type="date" name="date" value="{{ $event->date ?? '' }}"
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white" />
                @error('date')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Location -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Location</label>
                <input type="text" placeholder="e.g. Auditorium A, Main Campus" name="location"
                    value="{{ $event->location ?? '' }}"
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white" />
                @error('location')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Guest List -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Guests</label>
                <div id="guest-list" class="space-y-4">
                    @php
                        $guests = $event->guests ?? old('guests', [['name' => '', 'email' => '']]);
                    @endphp

                    @foreach($guests as $index => $guest)
                        <div class="flex flex-col md:flex-row gap-3">
                            <div class="flex-1">
                                <input type="text" name="guests[{{ $index }}][name]" placeholder="Guest Name"
                                    value="{{ $guest->guest['name'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" />
                                @if ($errors->has("guests.$index.name"))
                                    <div class="text-red-500 text-sm mt-1">{{ $errors->first("guests.$index.name") }}</div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="text" name="guests[{{ $index }}][email]" placeholder="Email"
                                    value="{{ $guest->guest['email'] ?? '' }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" />
                                @if ($errors->has("guests.$index.email"))
                                    <div class="text-red-500 text-sm mt-1">{{ $errors->first("guests.$index.email") }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Add Guest Button -->
                <button type="button" id="add-guest"
                    class="mt-4 px-4 py-2 text-sm font-medium text-blue-600 bg-blue-100 hover:bg-blue-200 rounded-lg transition duration-200">
                    + Add Another Guest
                </button>
                @error('guests')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-6">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold px-6 py-3 rounded-xl shadow-lg transform hover:scale-[1.02] transition duration-300 ease-in-out flex items-center justify-center gap-2">
                    @if($page === 'create')
                        🚀 Create Event
                    @else
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 407.096 407.096"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M402.115,84.008L323.088,4.981C319.899,1.792,315.574,0,311.063,0H17.005C7.613,0,0,7.614,0,17.005v373.086c0,9.392,7.613,17.005,17.005,17.005h373.086c9.392,0,17.005-7.613,17.005-17.005V96.032C407.096,91.523,405.305,87.197,402.115,84.008z M300.664,163.567H67.129V38.862h233.535V163.567z" />
                            <path
                                d="M214.051,148.16h43.08c3.131,0,5.668-2.538,5.668-5.669V59.584c0-3.13-2.537-5.668-5.668-5.668h-43.08c-3.131,0-5.668,2.538-5.668,5.668v82.907C208.383,145.622,210.92,148.16,214.051,148.16z" />
                        </svg>
                        <span>Save Changes</span>
                    @endif
                </button>

                @if(session('error'))
                    <div class="text-red-500 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="text-green-500 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </form>
    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let guestIndex = document.querySelectorAll('#guest-list > div').length;

            document.getElementById('add-guest').addEventListener('click', function () {
                const guestList = document.getElementById('guest-list');

                const newGuest = document.createElement('div');
                newGuest.classList.add('flex', 'flex-col', 'md:flex-row', 'gap-3');

                newGuest.innerHTML = `
                                    <div class="flex-1">
                                        <input type="text" name="guests[${guestIndex}][name]" placeholder="Guest Name"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" />
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" name="guests[${guestIndex}][email]" placeholder="Email"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" />
                                    </div>
                                `;

                guestList.appendChild(newGuest);
                guestIndex++;
            });
        });
    </script>
@endpush