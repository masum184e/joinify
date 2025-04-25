@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Student Advisor')
@section('layout-sub-title', 'Manage your club\'s events and members efficiently.')

@section('content')
  <div class="space-y-6 mb-8">
    <!-- Cards -->
    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

    <!-- Clubs -->
    <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-500">Clubs</p>
        <p class="text-2xl font-bold text-green-600">{{ $clubCount }}</p>
      </div>
      <div class="text-green-500 bg-green-100 p-2 rounded-full">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Members -->
    <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-500">Members</p>
        <p class="text-2xl font-bold text-green-600">{{ $memberCount }}</p>
      </div>
      <div class="text-green-500 bg-green-100 p-2 rounded-full">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5V4H2v16h5m5-3l3 3m0 0l-3 3m3-3H9" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Revenue -->
    <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-500">Revenue</p>
        <p class="text-2xl font-bold text-red-500">- $5,610</p>
      </div>
      <div class="text-red-500 bg-red-100 p-2 rounded-full">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Earnings -->
    <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-500">Earnings</p>
        <p class="text-2xl font-bold text-pink-500">$7,524</p>
      </div>
      <div class="text-pink-500 bg-pink-100 p-2 rounded-full">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Growth -->
    <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-500">Growth</p>
        <p class="text-2xl font-bold text-green-500">+ 35.52%</p>
      </div>
      <div class="text-green-500 bg-green-100 p-2 rounded-full">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12l5 5L20 7" />
        </svg>
      </div>
      </div>
    </div>

    </div>
    <!-- Chart & Pie -->
    <!-- Dashboard Metrics Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Total Member Card -->
    <div
      class="md:col-span-2 bg-gradient-to-br from-blue-50 to-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
      <h3 class="text-xl font-bold text-blue-800 flex items-center gap-2 mb-4">
      👥 Total Members
      </h3>
      <div class="bg-white p-4 rounded-lg border border-blue-100">
      <canvas id="clubChart" class="w-full h-48"></canvas>
      </div>

    </div>

    <!-- Revenue Card -->
    <div
      class="bg-gradient-to-br from-green-50 to-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
      <h3 class="text-xl font-bold text-green-800 flex items-center gap-2 mb-4">
      💰 Revenue
      </h3>
      <div
      class="bg-white h-48 rounded-lg flex items-center justify-center text-gray-400 border-2 border-dashed border-green-100">
      <canvas id="pieChart" class="w-full h-64 mt-6"></canvas>
      </div>
    </div>
    </div>


    <!-- Most Popular Clubs as Cards -->
    <div>
    <h3 class="text-2xl font-bold text-blue-800 mb-4">
      🌟 Most Popular Clubs
    </h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      @foreach($popularClubs as $club)
      <div
      class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 border-t-4 border-green-400">
      <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-bold text-gray-800">{{ $club->name }}</h3>
      <span class="text-sm bg-green-100 text-green-700 px-2 py-1 rounded-full">#{{ $loop->iteration }}</span>
      </div>
      <div class="grid grid-cols-3 gap-4 text-center">
      <!-- Fee -->
      <div class="flex flex-col items-center">
      <svg class="w-6 h-6 text-emerald-500 mb-1" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
        d="M12 8c-1.333 0-4 .667-4 2s2.667 2 4 2 4-.667 4-2-2.667-2-4-2z" />
        <path stroke-linecap="round" stroke-linejoin="round"
        d="M12 2v20m0-12c-1.333 0-4 .667-4 2s2.667 2 4 2 4-.667 4-2-2.667-2-4-2z" />
      </svg>
      <div class="text-base font-semibold text-gray-700">$120</div>
      </div>
      <!-- Members -->
      <div class="flex flex-col items-center">
      <svg class="w-6 h-6 text-blue-500 mb-1" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m10-1a4 4 0 10-7.9 0M12 14a4 4 0 100-8 4 4 0 000 8z" />
      </svg>
      <div class="text-base font-semibold text-gray-700">{{ $club->memberships_count }}</div>
      </div>
      <!-- Revenue -->
      <div class="flex flex-col items-center">
      <svg class="w-6 h-6 text-green-500 mb-1" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
        d="M12 8c-1.333 0-4 .667-4 2s2.667 2 4 2 4-.667 4-2-2.667-2-4-2z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v20" />
      </svg>
      <div class="text-base font-semibold text-green-600">$63.6k</div>
      </div>
      </div>
      </div>
    @endforeach

      <!-- You can add more cards below using the same structure -->
    </div>
    </div>

  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>

    // Bar Chart
    const ctx = document.getElementById('clubChart').getContext('2d');
    const clubChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: @json(array_keys($clubsMemberCount)),
      datasets: [{
      label: 'Number of Members',
      data: @json(array_values($clubsMemberCount)),
      backgroundColor: '#60a5fa',
      borderColor: '#1e293b',
      borderWidth: 1
      }]
    },
    options: {
      scales: {
      y: {
        beginAtZero: true,
        precision: 0
      }
      }
    }
    });

  </script>

@endpush