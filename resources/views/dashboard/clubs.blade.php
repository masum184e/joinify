@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Student Advisor')
@section('layout-sub-title', 'Manage your club\'s events and members efficiently.')

@section('content')
  <div class="mb-8">
    <!-- Search & Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between pb-4 gap-4 pt-2">

    <!-- Search Box -->
    <div class="relative w-full flex-1 ms-1">
      <input type="text" id="clubSearch" placeholder="Search club..."
      class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
      <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor"
      stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
      </svg>
    </div>
    <!-- Create Club Button -->
    <a href="/dashboard/clubs/create"
      class="inline-flex gap-2 items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition duration-300">

      <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"
      stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="feather feather-plus-circle">

      <g id="SVGRepo_bgCarrier" stroke-width="0" />
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
      <g id="SVGRepo_iconCarrier">
        <circle cx="12" cy="12" r="10" />
        <line x1="12" y1="8" x2="12" y2="16" />
        <line x1="8" y1="12" x2="16" y2="12" />
      </g>

      </svg>
      <span>Create New Club</span>
    </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($clubs as $club)

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden flex flex-col shadow-sm">
      <img src="{{ $club->banner ? asset('storage/' . $club->banner) : 'https://placehold.co/400x200' }}"
      alt="{{ $club->name }}" class="h-48 w-full object-cover">
      <div class="p-4 border-b border-gray-200">
      <h2 class="text-xl font-bold">{{ $club->name }}</h2>
      <p class="text-sm text-gray-500 flex justify-between">
      <span>{{ $club->memberships->count() }} members</span>
      <span>৳{{ $club->fee }}/month</span>
      </p>
      </div>
      <div class="p-4 flex-1">
      <p class="text-sm text-gray-500 mb-4">{{ $club->description }}</p>
      <div class="flex justify-between">
      @foreach($club->userRoles as $role)
      <span class="badge">
      <span
      class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $role->verified ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
      @if($role->verified)
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
      @else
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
      @endif
      {{ ucfirst($role->role) }}
      </span>
      </span>
      @endforeach
      </div>
      </div>
      <div class="p-4 border-t border-gray-200 flex justify-between ">
      <a href="/dashboard/clubs/{{ $club->id }}"
      class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-blue-600 text-white hover:bg-blue-600/90 px-4 py-2">
      View Details
      </a>
      <div>

      <div class="flex items-center">
      <!-- Edit Button -->
      <a href="/dashboard/clubs/{{ $club->id }}/edit"
        class="flex items-center gap-1 px-2 py-2 text-sm font-medium text-white bg-blue-500 rounded-l-md hover:bg-blue-600 transition duration-200 shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400"
        title="Edit Club">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 3.732z" />
        </svg>
      </a>

      <!-- Delete Button -->
      <form method="POST" action="{{ url('/dashboard/clubs/' . $club->id) }}" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure you want to delete this club?')"
        class="flex items-center gap-1 px-2 py-2 text-sm font-medium text-white bg-red-500 rounded-r-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
        title="Delete Club">
        <svg class="w-5 h-5" viewBox="-3 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#fff" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>trash</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-259.000000, -203.000000)" fill="#fff"> <path d="M282,211 L262,211 C261.448,211 261,210.553 261,210 C261,209.448 261.448,209 262,209 L282,209 C282.552,209 283,209.448 283,210 C283,210.553 282.552,211 282,211 L282,211 Z M281,231 C281,232.104 280.104,233 279,233 L265,233 C263.896,233 263,232.104 263,231 L263,213 L281,213 L281,231 L281,231 Z M269,206 C269,205.447 269.448,205 270,205 L274,205 C274.552,205 275,205.447 275,206 L275,207 L269,207 L269,206 L269,206 Z M283,207 L277,207 L277,205 C277,203.896 276.104,203 275,203 L269,203 C267.896,203 267,203.896 267,205 L267,207 L261,207 C259.896,207 259,207.896 259,209 L259,211 C259,212.104 259.896,213 261,213 L261,231 C261,233.209 262.791,235 265,235 L279,235 C281.209,235 283,233.209 283,231 L283,213 C284.104,213 285,212.104 285,211 L285,209 C285,207.896 284.104,207 283,207 L283,207 Z M272,231 C272.552,231 273,230.553 273,230 L273,218 C273,217.448 272.552,217 272,217 C271.448,217 271,217.448 271,218 L271,230 C271,230.553 271.448,231 272,231 L272,231 Z M267,231 C267.552,231 268,230.553 268,230 L268,218 C268,217.448 267.552,217 267,217 C266.448,217 266,217.448 266,218 L266,230 C266,230.553 266.448,231 267,231 L267,231 Z M277,231 C277.552,231 278,230.553 278,230 L278,218 C278,217.448 277.552,217 277,217 C276.448,217 276,217.448 276,218 L276,230 C276,230.553 276.448,231 277,231 L277,231 Z" id="trash" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
        </button>
      </form>
      </div>

      </div>
      </div>
    </div>
    @endforeach

    </div>

  </div>

@endsection