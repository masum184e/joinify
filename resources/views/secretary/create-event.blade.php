@extends('secretary.includes.layout')

@section('title', 'Create Event')

@section('content')
<div class="w-full max-w-3xl p-8 pt-0 mb-8 rounded-lg shadow-lg mx-auto">
<h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Create New Event</h2>

    <!-- Event Creation Form -->
    <form class="space-y-6">

      <!-- Event Title -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
        <input type="text" placeholder="e.g. Tech Talk 2025"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Description -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea rows="4" placeholder="Describe the event..."
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <!-- Date & Time -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
          <input type="time"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
         <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
          <input type="time"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
</div>

<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
          <input type="date"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>
        

      <!-- Location -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
        <input type="text" placeholder="e.g. Auditorium A, Main Campus"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Guest List -->
<div>
  <label class="block text-sm font-medium text-gray-700 mb-2">Guests</label>

  <div id="guest-list" class="space-y-4">
    <!-- Guest Row -->
    <div class="flex gap-2">
      <input type="text" name="guests[0][name]" placeholder="Guest Name"
             class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      <input type="designation" name="guests[0][designation]" placeholder="Designation"
             class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
  </div>

  <!-- Add Guest Button -->
  <button type="button" id="add-guest"
          class="mt-3 px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
    + Add Another Guest
  </button>
</div>


      <!-- Submit Button -->
      <div class="pt-4">
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
          Create Event
        </button>
      </div>


    </form>
  </div>
@endsection


@push('scripts')
<script>
  let guestIndex = 1;
  document.getElementById('add-guest').addEventListener('click', function () {
    const guestList = document.getElementById('guest-list');

    const newGuest = document.createElement('div');
    newGuest.classList.add('flex', 'gap-2');

    newGuest.innerHTML = `
      <input type="text" name="guests[${guestIndex}][name]" placeholder="Guest Name"
             class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      <input type="text" name="guests[${guestIndex}][designation]" placeholder="Designation"
             class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    `;

    guestList.appendChild(newGuest);
    guestIndex++;
  });
</script>
@endpush