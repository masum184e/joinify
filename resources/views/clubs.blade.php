@extends('includes.layout')

@section('title', 'Joinify')
@section('sub-title', 'All Clubs')

@section('content')

  <!-- Page Header -->
  <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <!-- Left: Title & Description -->
    <div>
    <h1 class="text-3xl font-bold text-blue-600">All Clubs</h1>
    <p class="text-gray-600 mt-1">Browse all active clubs on campus</p>
    </div>

    <!-- Right: Search Bar -->
    <!-- Search Box -->
    <div class="relative">
    <input type="text" id="clubSearch" placeholder="Search clubs..."
      class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-600 focus:outline-none" />
    <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor"
      viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"></path>
    </svg>
    </div>
  </div>


  <!-- Club Grid -->
  <div class="max-w-7xl mx-auto px-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    @foreach($clubs as $club)

    <div
      class="bg-gradient-to-br from-white via-gray-50 to-blue-50 rounded-xl shadow-lg hover:shadow-xl transition p-6 flex flex-col justify-between">
      <div>
      <!-- Club Title -->
      <h2 class="text-xl font-semibold mb-1 flex items-center gap-2">{{ $club->name }}</h2>

      <!-- Description -->
      <p class="text-gray-700 text-sm mb-4 text-justify">{{ $club->description }}</p>

      </div>

      <!-- Meta Info -->
      <div class="flex items-center justify-between text-sm text-gray-600 mt-auto pt-3 border-t border-gray-200">
      <!-- Member Count -->
      <div class="flex items-center gap-2">
      <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M17 20C17 18.3431 14.7614 17 12 17C9.23858 17 7 18.3431 7 20M21 17C21 15.77 19.77 14.71 18 14.25M3 17C3 15.77 4.23 14.71 6 14.25M18 10.24C18.61 9.69 19 8.89 19 8C19 6.34 17.66 5 16 5C15.23 5 14.53 5.29 14 5.76M6 10.24C5.39 9.69 5 8.89 5 8C5 6.34 6.34 5 8 5C8.77 5 9.47 5.29 10 5.76M12 14C10.34 14 9 12.66 9 11C9 9.34 10.34 8 12 8C13.66 8 15 9.34 15 11C15 12.66 13.66 14 12 14Z" />
      </svg>
      <span class="font-medium">{{ $club->memberships->count() }} Members</span>
      </div>

      <!-- Created Date -->
      <span class="text-xs text-gray-500">From {{ \Carbon\Carbon::parse($club->created_at)->format('M d, Y') }}</span>
      </div>

      <!-- View Button -->
      <div class="mt-4">
      <a href="/clubs/{{ $club->id }}"
      class="block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition text-center">
      View Club
      </a>
      </div>
    </div>


  @endforeach


    </div>
  </div>

@endsection