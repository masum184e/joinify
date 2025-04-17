@extends('secretary.includes.layout')

@section('title', 'Manage Events')

@section('content')
<div class="max-w-7xl mx-auto">
  <!-- Event Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Event Card -->
    <div class="bg-white shadow rounded-lg p-5 space-y-3 border border-gray-100">
      <h2 class="text-xl font-semibold text-gray-800">Tech Talk 2025</h2>
      <div class="text-sm text-gray-500">May 15, 2025</div>
      <div class="text-sm text-gray-700">10:00 AM - 12:00 PM</div>
      <div class="text-sm text-gray-700">Location: Auditorium A</div>
      <div class="text-sm text-gray-700">Guests: 3</div>

      <div class="flex justify-between gap-3 pt-3">
        <a href="/events/0" class="text-blue-600 text-sm hover:underline">View</a>
<div class="space-x-2">
<a href="/dashboard/edit-event/0" class="text-yellow-500 text-sm hover:underline">Edit</a>
<button onclick="confirm('Are you sure?')" class="text-red-600 text-sm hover:underline">Delete</button>
</div>
      </div>
    </div>

    <!-- Event Card -->
    <div class="bg-white shadow rounded-lg p-5 space-y-3 border border-gray-100">
      <h2 class="text-xl font-semibold text-gray-800">AI Workshop</h2>
      <div class="text-sm text-gray-500">June 10, 2025</div>
      <div class="text-sm text-gray-700">1:00 PM - 3:00 PM</div>
      <div class="text-sm text-gray-700">Location: Room 204</div>
      <div class="text-sm text-gray-700">Guests: 5</div>

      <div class="flex justify-between gap-3 pt-3">
        <a href="/events/0" class="text-blue-600 text-sm hover:underline">View</a>
        <div class="space-x-2">
<a href="/dashboard/edit-event/1" class="text-yellow-500 text-sm hover:underline">Edit</a>
<button onclick="confirm('Are you sure?')" class="text-red-600 text-sm hover:underline">Delete</button>
</div>
      </div>
    </div>

    <!-- Add more cards below -->

  </div>
</div>

<a href="/dashboard/create-event"
   class="fixed bottom-8 right-8 bg-teal-600 hover:bg-teal-700 text-white w-14 h-14 rounded-full flex items-center justify-center text-3xl shadow-lg transition duration-300">
  +
</a>
@endsection
