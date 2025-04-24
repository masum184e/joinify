@extends('includes.layout')

@section('title', 'Environment Club')

@section('content')
  <!-- Public/Student Club Details Page -->
  <div class="max-w-5xl mx-auto p-6 bg-white rounded-2xl shadow-lg mt-10">
    <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight flex items-center gap-2">
    {{ $club->name }}
    </h1>

    <!-- Description -->
    <p class="text-gray-700 text-base mb-6 leading-relaxed">
    {{ $club->description }}
    </p>


    <!-- Club Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <!-- Created At -->
    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-xl shadow-sm">
      <h2 class="font-semibold text-gray-600 text-sm uppercase mb-1">Created At</h2>
      <p class="text-lg font-bold text-gray-800">{{ \Carbon\Carbon::parse($club->created_at)->format('M d, Y') }}</p>
    </div>

    <!-- Total Members -->
    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl shadow-sm">
      <h2 class="font-semibold text-blue-700 text-sm uppercase mb-1">Total Members</h2>
      <p class="text-xl font-extrabold text-blue-900">{{ $club->userRoles->count() }}</p>
    </div>

    <!-- Revenue -->
    <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl shadow-sm">
      <h2 class="font-semibold text-green-700 text-sm uppercase mb-1">Monthly Fee</h2>
      <p class="text-xl font-extrabold text-green-900">$123,126</p>
    </div>

    </div>


    <div class="mb-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Executive Members</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

      <!-- President -->
      <div
      class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
      <div class="mb-2 flex items-center justify-between">
        <h3 class="text-lg font-bold text-blue-900">President</h3>
        <div class="bg-white p-2 rounded-full shadow text-blue-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0a1 1 0 00.95.69h1.518c.969 0 1.371 1.24.588 1.81l-1.23.89a1 1 0 00-.364 1.118l.47 1.45c.3.921-.755 1.688-1.54 1.118l-1.23-.89a1 1 0 00-1.176 0l-1.23.89c-.785.57-1.84-.197-1.54-1.118l.47-1.45a1 1 0 00-.364-1.118l-1.23-.89c-.783-.57-.38-1.81.588-1.81h1.518a1 1 0 00.95-.69z" />
          <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 14.25c-4.97 0-9 2.012-9 4.5V21h18v-2.25c0-2.488-4.03-4.5-9-4.5z" />
        </svg>
        </div>
      </div>
      <p class="text-gray-900 font-semibold">{{ $club->president?->user?->name }}</p>
      <p class="text-sm text-gray-700">{{ $club->president?->user?->email }}</p>
      </div>

      <!-- Secretary -->
      <div
      class="bg-gradient-to-br from-indigo-100 to-indigo-200 p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
      <div class="mb-2 flex items-center justify-between">
        <h3 class="text-lg font-bold text-indigo-900">Secretary</h3>
        <div class="bg-white p-2 rounded-full shadow text-indigo-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
          d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
        </svg>
        </div>
      </div>
      <p class="text-gray-900 font-semibold">{{ $club->secretary?->user?->name }}</p>
      <p class="text-sm text-gray-700">{{ $club->secretary?->user?->email }}</p>
      </div>

      <!-- Accountant -->
      <div
      class="bg-gradient-to-br from-green-100 to-green-200 p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
      <div class="mb-2 flex items-center justify-between">
        <h3 class="text-lg font-bold text-green-900">Accountant</h3>
        <div class="bg-white p-2 rounded-full shadow text-green-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 8c-1.105 0-2 .672-2 1.5S10.895 11 12 11s2 .672 2 1.5S13.105 14 12 14s-2 .672-2 1.5S10.895 17 12 17m0-9v1m0 8v1m0-10a9 9 0 110 18 9 9 0 010-18z" />
        </svg>
        </div>
      </div>
      <p class="text-gray-900 font-semibold">{{ $club->accountant?->user?->name }}</p>
      <p class="text-sm text-gray-700">{{ $club->accountant?->user?->email }}</p>
      </div>

    </div>
    </div>

    <div class="mt-6">
    <a href="/clubs/{{ $club->id }}/join"
      class="flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-bold px-5 py-3 rounded-xl shadow-lg transition-all duration-300 w-full text-center">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
      Join Club
    </a>

    </div>
  </div>
@endsection