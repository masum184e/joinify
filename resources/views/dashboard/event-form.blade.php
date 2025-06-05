@extends('dashboard.includes.layout')

@section('title',  ($page === 'create')?'Create New Event':'Update Event Details')
@section('sub-title', $club->name)

@section('layout-title', ($page === 'create')?'Create New Event':'Update Event Details')
@section('layout-sub-title', ($page === 'create')?'Fill in the details to create a new club event':'Fill in the details to update event information')

@section('content')

    <div class="container">
        <a href="/dashboard/clubs/{{ $club->id ?? '' }}/events"
            class="inline-flex items-center justify-center text-blue-600 rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50  h-10 py-2 mb-4">
            <i class="ri-arrow-left-line mr-2"></i>
            Back to Events
        </a>
        <!-- Form with proper method, action, and enctype -->
        <form method="POST"
            action="{{ $page === 'create' ? '/dashboard/clubs/' . $club->id . '/events' : '/dashboard/clubs/' . $club->id . '/events/' . $event->id }}"
            enctype="multipart/form-data">
            @csrf
            @if($page === 'edit')
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg border border-border shadow-sm">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h2>
                        <div class="space-y-2">
                            <label for="title"
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Event
                                Title</label>
                            <input id="title" name="title" placeholder="Enter event title"
                                value="{{ $event->title ?? old('title') }}"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 @error('title') border-red-500 @enderror">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2 mt-4">
                            <label for="description"
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Description</label>
                            <textarea id="description" name="description" placeholder="Describe events activities" rows="5"
                                class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 @error('description') border-red-500 @enderror">{{ $event->description ?? old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Date and Time -->
                <div class="bg-white rounded-lg border border-border shadow-sm">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Date and Time</h2>
                        <div class="space-y-2">
                            <label for="date"
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Event
                                Date</label>
                            <input type="date" id="date" name="date" value="{{ $event->date ?? old('date') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white @error('date') border-red-500 @enderror" />
                            @error('date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2 mt-4">
                            <label for="start_time"
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Start
                                Time</label>
                            <input type="time" id="start_time" name="start_time"
                                value="{{ $event->start_time ?? old('start_time') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white @error('start_time') border-red-500 @enderror" />
                            @error('start_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2 mt-4">
                            <label for="end_time"
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">End
                                Time</label>
                            <input type="time" id="end_time" name="end_time"
                                value="{{ $event->end_time ?? old('end_time') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white @error('end_time') border-red-500 @enderror" />
                            @error('end_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-border shadow-sm h-min">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Location</h2>
                        <div class="space-y-2">
                            <label for="location"
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Event
                                Location</label>
                            <input id="location" name="location" placeholder="Enter event location"
                                value="{{ $event->location ?? old('location') }}"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 @error('location') border-red-500 @enderror">
                            @error('location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2 mt-4">
                            <label for="poster" class="block text-sm font-medium text-gray-700">Event Image</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md @error('poster') border-red-500 @enderror">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="poster"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600">
                                            <span>Upload a file</span>
                                            <input id="poster" name="poster" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                            @error('poster')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mt-2">
                                <p id="preview-title"
                                    class="text-sm text-gray-500 {{ isset($event) && $event->poster ? '' : 'hidden' }}">
                                    Image Preview:</p>
                                <div class="mt-1">
                                    <img id="poster-preview"
                                        src="{{ isset($event) && $event->poster ? asset('storage/' . $event->poster) : '#' }}"
                                        alt="Image Preview"
                                        class="h-32 w-auto object-cover rounded-md {{ isset($event) && $event->poster ? '' : 'hidden' }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-border shadow-sm h-min">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Guests</h2>

                        <!-- Display any guest-related errors at the top -->
                        @if ($errors->has('guests') || $errors->has('guests.*'))
                            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-md">
                                <p class="text-red-600 text-sm font-medium">Please check the guest information for errors</p>
                            </div>
                        @endif

                        <div id="guest-list" class="space-y-4">
                            @php
                                $event->guests ?? old('guests', [['name' => '', 'email' => '']]);

                                $guests = $event->guests ?? old('guests', [['name' => '', 'email' => ''], ['name' => '', 'email' => ''], ['name' => '', 'email' => ''], ['name' => '', 'email' => '']]);
                                if (!is_array($guests) && is_object($guests)) {
                                    $guests = $guests->toArray();
                                }

                            @endphp
                            @foreach($guests as $index => $guest)

                                <div class="flex flex-col md:flex-row gap-3 guest-item">
                                    <div class="flex-1">
                                        <input type="text" name="guests[{{ $index }}][name]" placeholder="Guest Name"
                                            value="{{ old('guests.' . $index . '.name', $guest['name'] ?? '') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white @error('guests.' . $index . '.name') border-red-500 @enderror" />
                                        @error('guests.' . $index . '.name')
                                            <div class="text-red-500 text-sm mt-1">Guest name is required</div>
                                        @enderror
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" name="guests[{{ $index }}][email]" placeholder="Email"
                                            value="{{ old('guests.' . $index . '.email', $guest['email'] ?? '') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white @error('guests.' . $index . '.email') border-red-500 @enderror" />
                                        @error('guests.' . $index . '.email')
                                            <div class="text-red-500 text-sm mt-1">Valid email is required</div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center">
                                        <button type="button"
                                            class="remove-guest p-2 text-red-500 hover:text-red-700 focus:outline-none"
                                            title="Remove guest">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Add Guest Button -->
                        <button type="button" id="add-guest"
                            class="mt-4 px-4 py-2 text-sm font-medium text-blue-600 bg-blue-100 hover:bg-blue-200 rounded-lg transition duration-200">
                            + Add Another Guest
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-6 px-6 py-4 flex items-center justify-end space-x-3">
                <button type="reset" id="reset-btn"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Reset
                </button>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    {{ $page === 'create' ? 'Create Event' : 'Update Event' }}
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let guestIndex = document.querySelectorAll('#guest-list > div').length;

            // Add guest functionality
            document.getElementById('add-guest').addEventListener('click', function () {
                const guestList = document.getElementById('guest-list');

                const newGuest = document.createElement('div');
                newGuest.classList.add('flex', 'flex-col', 'md:flex-row', 'gap-3', 'guest-item');

                newGuest.innerHTML = `
                                                                                        <div class="flex-1">
                                                                                            <input type="text" name="guests[${guestIndex}][name]" placeholder="Guest Name"
                                                                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" />
                                                                                        </div>
                                                                                        <div class="flex-1">
                                                                                            <input type="text" name="guests[${guestIndex}][email]" placeholder="Email"
                                                                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" />
                                                                                        </div>
                                                                                        <div class="flex items-center">
                                                                                            <button type="button" class="remove-guest p-2 text-red-500 hover:text-red-700 focus:outline-none" title="Remove guest">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                                                </svg>
                                                                                            </button>
                                                                                        </div>
                                                                                    `;

                guestList.appendChild(newGuest);
                guestIndex++;

                // Add event listener to the new remove button
                attachRemoveListeners(newGuest.querySelector('.remove-guest'));
            });

            // Remove guest functionality
            function attachRemoveListeners(button) {
                button.addEventListener('click', function () {
                    this.closest('.guest-item').remove();
                    // Reindex the remaining guests
                    reindexGuests();
                });
            }

            // Attach remove listeners to existing buttons
            document.querySelectorAll('.remove-guest').forEach(button => {
                attachRemoveListeners(button);
            });

            // Reindex guest inputs after removal
            function reindexGuests() {
                const guestItems = document.querySelectorAll('.guest-item');
                guestItems.forEach((item, index) => {
                    const nameInput = item.querySelector('input[name^="guests"][name$="[name]"]');
                    const emailInput = item.querySelector('input[name^="guests"][name$="[email]"]');

                    if (nameInput) {
                        nameInput.name = `guests[${index}][name]`;
                    }

                    if (emailInput) {
                        emailInput.name = `guests[${index}][email]`;
                    }
                });

                // Update the guest index for adding new guests
                guestIndex = guestItems.length;
            }

            // Preview uploaded poster image
            const posterInput = document.getElementById('poster');
            const posterPreview = document.getElementById('poster-preview');
            const previewTitle = document.getElementById('preview-title');

            posterInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        posterPreview.src = e.target.result;
                        posterPreview.classList.remove('hidden');
                        previewTitle.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    posterPreview.src = '#';
                    posterPreview.classList.add('hidden');
                    previewTitle.classList.add('hidden');
                }
            });

        });
    </script>
@endpush