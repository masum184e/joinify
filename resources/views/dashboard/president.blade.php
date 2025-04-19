@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'President')

@section('layout-title', 'Club President')
@section('layout-sub-title', 'Manage your club, track events, and oversee member activities.')

@section('content')

  <div class="max-w-7xl mx-auto mb-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

    <!-- Total Members -->
    <div class="bg-gradient-to-br from-purple-100 to-purple-200 p-6 rounded-2xl shadow-lg border-l-4 border-purple-600">
      <div class="flex items-center justify-between">
      <div>
        <h2 class="text-sm font-medium text-purple-700 uppercase">Total Members</h2>
        <p class="text-3xl font-extrabold text-purple-900 mt-1">150</p>
      </div>
      <div class="bg-purple-500 text-white rounded-full p-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 110 8 4 4 0 010-8zM8 7a4 4 0 100 8 4 4 0 000-8z" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Upcoming Events -->
    <div class="bg-gradient-to-br from-green-100 to-green-200 p-6 rounded-2xl shadow-lg border-l-4 border-green-600">
      <div class="flex items-center justify-between">
      <div>
        <h2 class="text-sm font-medium text-green-700 uppercase">Upcoming Events</h2>
        <p class="text-3xl font-extrabold text-green-900 mt-1">7</p>
      </div>
      <div class="bg-green-500 text-white rounded-full p-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Total Events -->
    <div class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 rounded-2xl shadow-lg border-l-4 border-blue-600">
      <div class="flex items-center justify-between">
      <div>
        <h2 class="text-sm font-medium text-blue-700 uppercase">Total Events</h2>
        <p class="text-3xl font-extrabold text-blue-900 mt-1">5</p>
      </div>
      <div class="bg-blue-500 text-white rounded-full p-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M9.75 17L9 21l3.75-1.5L16.5 21l-.75-4m3.25-7a3.5 3.5 0 11-7 0 3.5 3.5 0 017 0zM4.75 5a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0zM3 21v-2a4 4 0 014-4h3.5" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Total Guests -->
    <div class="bg-gradient-to-br from-indigo-100 to-indigo-200 p-6 rounded-2xl shadow-lg border-l-4 border-indigo-600">
      <div class="flex items-center justify-between">
      <div>
        <h2 class="text-sm font-medium text-indigo-700 uppercase">Total Guests</h2>
        <p class="text-3xl font-extrabold text-indigo-900 mt-1">5</p>
      </div>
      <div class="bg-indigo-500 text-white rounded-full p-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4s-4 1.79-4 4 1.79 4 4 4zM4 20c0-2.21 3.58-4 8-4s8 1.79 8 4v1H4v-1z" />
        </svg>
      </div>
      </div>
    </div>

    </div>

    <!-- Recent Club Activities -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
      <h2 class="text-lg font-bold text-gray-800">📝 Recent Club Activities</h2>
      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
      </svg>
    </div>
    <ul class="divide-y divide-gray-100">

      <!-- Activity 1 -->
      <li class="px-6 py-4 hover:bg-gray-50 transition">
      <div class="flex items-start justify-between">
        <div class="flex items-start gap-3">
        <div class="bg-green-100 text-green-600 p-2 rounded-full">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-800">New Member Approved</h3>
          <p class="text-sm text-gray-500">Sarah Johnson has been approved as a new member</p>
        </div>
        </div>
        <p class="text-sm text-gray-400 mt-1">2 days ago</p>
      </div>
      </li>

      <!-- Activity 2 -->
      <li class="px-6 py-4 hover:bg-gray-50 transition">
      <div class="flex items-start justify-between">
        <div class="flex items-start gap-3">
        <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m2 0a2 2 0 110 4H7a2 2 0 110-4h10z" />
          </svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-800">Event Proposal Submitted</h3>
          <p class="text-sm text-gray-500">AI Workshop proposal has been submitted by the Secretary</p>
        </div>
        </div>
        <p class="text-sm text-gray-400 mt-1">5 days ago</p>
      </div>
      </li>

      <!-- Activity 3 -->
      <li class="px-6 py-4 hover:bg-gray-50 transition">
      <div class="flex items-start justify-between">
        <div class="flex items-start gap-3">
        <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 10h11M9 21V3m4 18h4a2 2 0 002-2v-5a2 2 0 00-2-2h-4v9z" />
          </svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-800">Budget Report Updated</h3>
          <p class="text-sm text-gray-500">The club budget for Q1 2025 has been updated</p>
        </div>
        </div>
        <p class="text-sm text-gray-400 mt-1">1 week ago</p>
      </div>
      </li>

    </ul>
    </div>


    <!-- Upcoming Events -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden mt-8">
    <div
      class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100 flex items-center justify-between">
      <h2 class="text-lg font-semibold text-blue-800 flex items-center gap-2">📅 Upcoming Events </h2>
      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
    </div>
    <ul class="divide-y divide-gray-100">
      <!-- Event 1 -->
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
          <h3 class="font-semibold text-gray-800">AI Workshop</h3>
          <p class="text-sm text-gray-500">June 10, 2025</p>
        </div>
        </div>
        <a href="/dashboard/events/0" class="text-blue-600 text-sm font-medium hover:underline flex items-center gap-1">
        View
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        </a>
      </div>
      </li>

    </ul>
    </div>

  </div>

@endsection