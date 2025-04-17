@extends('president.includes.layout')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">
  <!-- Header -->
  <h1 class="text-3xl font-bold text-blue-600 mb-4">President Dashboard</h1>
  <p class="text-gray-600 mb-8">Manage your club, track events, and oversee member activities.</p>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
  <div class="bg-white p-6 rounded-lg shadow border-l-4 border-purple-500">
      <h2 class="text-sm font-medium text-gray-500 uppercase">Total Members</h2>
      <p class="text-2xl font-bold text-gray-800 mt-1">150</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
      <h2 class="text-sm font-medium text-gray-500 uppercase">Upcoming Events</h2>
      <p class="text-2xl font-bold text-gray-800 mt-1">7</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
      <h2 class="text-sm font-medium text-gray-500 uppercase">Total Events</h2>
      <p class="text-2xl font-bold text-gray-800 mt-1">5</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
      <h2 class="text-sm font-medium text-gray-500 uppercase">Total Guests</h2>
      <p class="text-2xl font-bold text-gray-800 mt-1">5</p>
    </div>
  
  </div>


  <!-- Recent Club Activities -->
  <div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
      <h2 class="text-lg font-semibold text-gray-800">Recent Club Activities</h2>
    </div>
    <ul class="divide-y divide-gray-100">
      <li class="px-6 py-4">
        <div class="flex justify-between">
          <div>
            <h3 class="font-medium text-gray-800">New Member Approved</h3>
            <p class="text-sm text-gray-500">Sarah Johnson has been approved as a new member</p>
          </div>
          <p class="text-sm text-gray-500">2 days ago</p>
        </div>
      </li>
      <li class="px-6 py-4">
        <div class="flex justify-between">
          <div>
            <h3 class="font-medium text-gray-800">Event Proposal Submitted</h3>
            <p class="text-sm text-gray-500">AI Workshop proposal has been submitted by the Secretary</p>
          </div>
          <p class="text-sm text-gray-500">5 days ago</p>
        </div>
      </li>
      <li class="px-6 py-4">
        <div class="flex justify-between">
          <div>
            <h3 class="font-medium text-gray-800">Budget Report Updated</h3>
            <p class="text-sm text-gray-500">The club budget for Q1 2025 has been updated</p>
          </div>
          <p class="text-sm text-gray-500">1 week ago</p>
        </div>
      </li>
    </ul>
  </div>

  <!-- Recent Events -->
  <div class="bg-white shadow rounded-lg overflow-hidden mt-8">
    <div class="px-6 py-4 border-b border-gray-200">
      <h2 class="text-lg font-semibold text-gray-800">Upcoming Events</h2>
    </div>
    <ul class="divide-y divide-gray-100">
      <li class="px-6 py-4">
        <div class="flex justify-between">
          <div>
            <h3 class="font-medium text-gray-800">Tech Talk 2025</h3>
            <p class="text-sm text-gray-500">May 15, 2025</p>
          </div>
          <a href="#" class="text-blue-600 text-sm hover:underline self-center">View</a>
        </div>
      </li>
      <li class="px-6 py-4">
        <div class="flex justify-between">
          <div>
            <h3 class="font-medium text-gray-800">AI Workshop</h3>
            <p class="text-sm text-gray-500">June 10, 2025</p>
          </div>
          <a href="#" class="text-blue-600 text-sm hover:underline self-center">View</a>
        </div>
      </li>
    </ul>
  </div>
</div>

@endsection
