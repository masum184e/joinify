@extends('includes.layout')

@section('title', 'Environment Club')

@section('content')
  <div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-lg mt-10">
    <div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-gray-800">👤 Member Information</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Full Name -->
    <div>
      <h3 class="text-sm text-gray-500">Full Name</h3>
      <p class="text-lg font-semibold text-gray-800">Jane Doe</p>
    </div>

    <!-- Student ID -->
    <div>
      <h3 class="text-sm text-gray-500">Student ID</h3>
      <p class="text-lg font-semibold text-gray-800">202312345</p>
    </div>

    <!-- Email -->
    <div>
      <h3 class="text-sm text-gray-500">Email</h3>
      <p class="text-lg font-semibold text-gray-800">jane.doe@university.edu</p>
    </div>

    <!-- Department -->
    <div>
      <h3 class="text-sm text-gray-500">Department</h3>
      <p class="text-lg font-semibold text-gray-800">Computer Science</p>
    </div>
    </div>

    <!-- Club Memberships -->
    <div class="mt-6">
    <h2 class="text-xl font-bold text-gray-800">🌟 Member Of</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
      <!-- Tech Club Card -->
      <div
      class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl shadow-md p-5 hover:shadow-lg transition">
      <div class="flex items-center mb-3">
        <div class="bg-blue-600 text-white p-3 rounded-full mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a8 8 0 00-8 8h16a8 8 0 00-8-8z"></path>
        </svg>
        </div>
        <div>
        <h3 class="text-lg font-semibold text-blue-700">Tech Club</h3>
        <p class="text-sm text-blue-600">President</p>
        </div>
      </div>
      </div>

      <!-- Robotics Club Card -->
      <div
      class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl shadow-md p-5 hover:shadow-lg transition">
      <div class="flex items-center mb-3">
        <div class="bg-green-600 text-white p-3 rounded-full mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M3 7v4a1 1 0 001 1h3m10-6h3a1 1 0 011 1v4m-9-5v6m0 0H9m3 0h3"></path>
        </svg>
        </div>
        <div>
        <h3 class="text-lg font-semibold text-green-700">Robotics Club</h3>
        <p class="text-sm text-green-600">Member</p>
        </div>
      </div>
      </div>

      <!-- Coding Club Card -->
      <div
      class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl shadow-md p-5 hover:shadow-lg transition">
      <div class="flex items-center mb-3">
        <div class="bg-purple-600 text-white p-3 rounded-full mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M8 16v-1a4 4 0 014-4h4m-6 0a4 4 0 014-4h4M5 19h14M5 21h14M3 7h18"></path>
        </svg>
        </div>
        <div>
        <h3 class="text-lg font-semibold text-purple-700">Coding Club</h3>
        <p class="text-sm text-purple-600">Member</p>
        </div>
      </div>
      </div>

    </div>
    </div>
  </div>

@endsection