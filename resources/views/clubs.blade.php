@extends('includes.layout')

@section('title', 'Joinify')
@section('sub-title', 'Browse Clubs')

@section('content')

  <!-- Page Header -->
  <section class="pt-32 pb-10 bg-gradient-to-b from-primary-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
      <div>
      <h1 class="text-4xl font-bold text-gray-900 font-poppins">Discover Campus Clubs</h1>
      <p class="text-xl text-gray-600 mt-2">Find your community and pursue your passions</p>
      </div>

      <div class="relative max-w-md w-full">
      <input type="text" placeholder="Search clubs..."
        class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all" />
      <i class="ri-search-line absolute left-4 top-3.5 text-gray-400 text-xl"></i>
      </div>
    </div>

    <!-- Filter Tags -->
    <div class="flex flex-wrap gap-2 mt-6">
      <button class="bg-primary-600 text-white px-4 py-2 rounded-full text-sm font-medium">All Clubs</button>
      <button
      class="bg-white text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-full text-sm font-medium border border-gray-200">Academic</button>
      <button
      class="bg-white text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-full text-sm font-medium border border-gray-200">Arts</button>
      <button
      class="bg-white text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-full text-sm font-medium border border-gray-200">Cultural</button>
      <button
      class="bg-white text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-full text-sm font-medium border border-gray-200">Sports</button>
      <button
      class="bg-white text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-full text-sm font-medium border border-gray-200">Technology</button>
      <button
      class="bg-white text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-full text-sm font-medium border border-gray-200">Social</button>
    </div>
    </div>
  </section>

  <!-- Clubs Grid -->
  <section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Club Card 1 -->
      @foreach($clubs as $club)
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover">
      <div class="h-48 bg-gradient-to-r from-primary-500 to-primary-700 relative">
      <img src="{{ $club->banner ? asset('storage/' . $club->banner) : 'https://placehold.co/400x200' }}"
      alt="{{ $club->name }}" class="w-full h-full object-cover mix-blend-overlay" />
      <div
      class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-primary-600 font-bold px-3 py-1 rounded-full text-sm">
      {{ $club->memberships_count }} Members
      </div>
      </div>
      <div class="p-6">
      <div class="flex items-center mb-4">
      <!-- <div class="p-2 bg-primary-100 rounded-full">
      <i class="ri-camera-line text-xl text-primary-600"></i>
      </div> -->
      <h3 class="text-xl font-bold text-gray-900">
        {{ $club->name }}
      </h3>
      </div>
      <p class="text-gray-600 mb-6">{{ $club->description }}</p>
      <div class="flex justify-between items-center">
      <div class="flex -space-x-2">
        @if ($club->memberships_count > 3)
      <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Member"
      class="w-8 h-8 rounded-full border-2 border-white" />
      <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Member"
      class="w-8 h-8 rounded-full border-2 border-white" />
      <img src="https://randomuser.me/api/portraits/women/48.jpg" alt="Member"
      class="w-8 h-8 rounded-full border-2 border-white" />
      <div
      class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs font-medium text-gray-500">
      +{{ $club->memberships_count - 3 }}
      </div>
      @endif
      </div>

      <a href="/clubs/{{ $club->id }}"
        class="text-primary-600 font-semibold hover:text-primary-700 transition">View Club
        →</a>
      </div>
      </div>
      </div>
    @endforeach

    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-12">
      <nav class="flex items-center space-x-2">
      <a href="#"
        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 hover:bg-gray-50">
        <i class="ri-arrow-left-s-line"></i>
      </a>
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary-600 text-white">1</a>
      <a href="#"
        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">2</a>
      <a href="#"
        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">3</a>
      <span class="text-gray-500">...</span>
      <a href="#"
        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">8</a>
      <a href="#"
        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 hover:bg-gray-50">
        <i class="ri-arrow-right-s-line"></i>
      </a>
      </nav>
    </div>
    </div>
  </section>


@endsection