@extends('includes.layout')

@section('title', 'Joinify')

@section('content')

  <!-- Page Header -->
  <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
  <!-- Left: Title & Description -->
  <div>
    <h1 class="text-3xl font-bold text-blue-600">All Student Clubs</h1>
    <p class="text-gray-600 mt-1">Browse all active clubs on campus</p>
  </div>

  <!-- Right: Search Bar -->
<!-- Search Box -->
<div class="relative">
      <input
        type="text"
        id="clubSearch"
        placeholder="Search clubs..."
        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-teal-500 focus:outline-none"
      />
      <svg
        class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 pointer-events-none"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"></path>
      </svg>
    </div>
</div>


  <!-- Club Grid -->
  <div class="max-w-7xl mx-auto px-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      
      <!-- Club Card Example -->
      <!-- Club Card -->
<div class="bg-white rounded-xl shadow hover:shadow-md p-5 transition flex flex-col justify-between">
  <div>
    <h2 class="text-xl font-semibold text-gray-800 mb-1">Robotics Club</h2>
    <p class="text-gray-700 text-sm mb-4">
      Build, program, and compete with robots across the nation.
    </p>
  </div>

  <!-- Member Count and Created Date -->
  <div class="flex items-center justify-between text-sm text-gray-500 mt-auto pt-2">
    <!-- Left: Member Icon + Count -->
    <div class="flex items-center gap-1">
      <!-- Heroicons user-group icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 12a4 4 0 100-8 4 4 0 000 8zm6 8v-2a4 4 0 00-3-3.87M6 12a4 4 0 100-8 4 4 0 000 8z" />
      </svg>
      <span>32</span>
    </div>

    <!-- Right: Created Date -->
    <span>Jan 12, 2023</span>
  </div>

  <!-- View Button -->
  <div class="mt-3 text-right">
    <a href="/clubs/0" class="text-blue-600 font-medium hover:underline text-sm">View Club</a>
  </div>
</div>

      <!-- Add more club cards as needed -->

    </div>
  </div>

  @endsection
