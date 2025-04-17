@extends('secretary.includes.layout')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">
  <!-- Header -->
  <h1 class="text-3xl font-bold text-blue-600 mb-4">Secretary Dashboard</h1>
  <p class="text-gray-600 mb-8">Manage your club's events and members efficiently.</p>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
      <h2 class="text-sm font-medium text-gray-500 uppercase">Total Events</h2>
      <p class="text-2xl font-bold text-gray-800 mt-1">12</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
      <h2 class="text-sm font-medium text-gray-500 uppercase">Upcoming Events</h2>
      <p class="text-2xl font-bold text-gray-800 mt-1">3</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-purple-500">
      <h2 class="text-sm font-medium text-gray-500 uppercase">Total Guests</h2>
      <p class="text-2xl font-bold text-gray-800 mt-1">25</p>
    </div>
  </div>


  <!-- Recent Events -->
  <div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
      <h2 class="text-lg font-semibold text-gray-800">Recent Events</h2>
    </div>
    <ul class="divide-y divide-gray-100">
      <li class="px-6 py-4">
        <div class="flex justify-between">
          <div>
            <h3 class="font-medium text-gray-800">AI Workshop</h3>
            <p class="text-sm text-gray-500">June 10, 2025</p>
          </div>
          <a href="/events/0" class="text-blue-600 text-sm hover:underline self-center">View</a>
        </div>
      </li>
      <li class="px-6 py-4">
        <div class="flex justify-between">
          <div>
            <h3 class="font-medium text-gray-800">Tech Talk 2025</h3>
            <p class="text-sm text-gray-500">May 15, 2025</p>
          </div>
          <a href="/events/0" class="text-blue-600 text-sm hover:underline self-center">View</a>
        </div>
      </li>
      <li class="px-6 py-4">
        <div class="flex justify-between">
          <div>
            <h3 class="font-medium text-gray-800">Tech Talk 2025</h3>
            <p class="text-sm text-gray-500">May 15, 2025</p>
          </div>
          <a href="/events/0" class="text-blue-600 text-sm hover:underline self-center">View</a>
        </div>
      </li>
      <li class="px-6 py-4">
        <div class="flex justify-between">
          <div>
            <h3 class="font-medium text-gray-800">Tech Talk 2025</h3>
            <p class="text-sm text-gray-500">May 15, 2025</p>
          </div>
          <a href="/events/0" class="text-blue-600 text-sm hover:underline self-center">View</a>
        </div>
      </li>
      <!-- Add more events as needed -->
    </ul>
  </div>
</div>


@endsection
