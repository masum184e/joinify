@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Student Advisor')
@section('layout-sub-title', 'Manage your club\'s events and members efficiently.')

@section('content')
  <div class="space-y-6 mb-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

    <!-- Clubs -->
    <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-500">Clubs</p>
        <p class="text-2xl font-bold text-indigo-600">{{ $clubCount }}</p>
      </div>
      <div class="text-indigo-500 bg-indigo-100 p-2 rounded-full">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5l-4-4-4 4" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Members -->
    <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-500">Members</p>
        <p class="text-2xl font-bold text-blue-600">{{ $memberCount }}</p>
      </div>
      <div class="text-blue-500 bg-blue-100 p-2 rounded-full">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 20h5V4H2v16h5m5-3l3 3m0 0l-3 3m3-3H9" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Revenue -->
    <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-500">Revenue</p>
        <p class="text-2xl font-bold text-green-600">${{ number_format($totalRevenue, 2) }}</p>
      </div>
      <div class="text-green-500 bg-green-100 p-2 rounded-full">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 8c0-2.21 2.69-4 6-4s6 1.79 6 4-2.69 4-6 4-6-1.79-6-4zm0 4c0 2.21-2.69 4-6 4s-6-1.79-6-4 2.69-4 6-4 6 1.79 6 4z" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Expense -->
    <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-500">Expense</p>
        <p class="text-2xl font-bold text-red-600">${{ number_format($totalExpenses, 2) }}</p>
      </div>
      <div class="text-red-500 bg-red-100 p-2 rounded-full">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m0-8l-3 3m3-3l3 3" />
        </svg>
      </div>
      </div>
    </div>

    <!-- Net Balance -->
    <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between">
      <div>
        <p class="text-sm text-gray-500">Net Balance</p>
        <p class="text-2xl font-bold text-purple-600">${{ number_format($netBalance, 2) }}</p>
      </div>
      <div class="text-purple-500 bg-purple-100 p-2 rounded-full">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
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
      <div class="bg-white h-48 p-4 rounded-lg border border-blue-100">
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
      <canvas id="revenuePieChart" class="w-full h-48"></canvas>
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
      <div class="text-base font-semibold text-gray-700">${{ $club->fee }}</div>
      <div class="text-xs text-gray-400 mt-1">Fees</div>
      </div>
      <!-- Members -->
      <div class="flex flex-col items-center">
      <svg class="w-6 h-6 text-blue-500 mb-1" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m10-1a4 4 0 10-7.9 0M12 14a4 4 0 100-8 4 4 0 000 8z" />
      </svg>
      <div class="text-base font-semibold text-gray-700">{{ $club->memberships_count }}</div>
      <div class="text-xs text-gray-400 mt-1">Members</div>
      </div>
      <!-- Revenue -->
      <div class="flex flex-col items-center">
      <svg class="w-6 h-6 text-green-500 mb-1" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
        d="M12 8c-1.333 0-4 .667-4 2s2.667 2 4 2 4-.667 4-2-2.667-2-4-2z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v20" />
      </svg>
      <div class="text-base font-semibold text-green-600">${{ $club->revenue }}</div>
      <div class="text-xs text-gray-400 mt-1">Revenue</div>
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
    const clubCtx = document.getElementById('clubChart').getContext('2d');
    const clubChart = new Chart(clubCtx, {
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
      responsive: true,
      maintainAspectRatio: false,
      scales: {
      y: {
        beginAtZero: true,
        precision: 0
      }
      }
    }
    });

    // Pie Chart
    const pieCtx = document.getElementById('revenuePieChart').getContext('2d');
    const revenuePieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
      labels: @json(array_keys($clubRevenue)),
      datasets: [{
      data: @json(array_values($clubRevenue)),
      backgroundColor: [
        '#4F46E5', '#22C55E', '#EC4899', '#F59E0B', '#3B82F6', '#10B981', '#F43F5E'
      ],
      borderWidth: 1,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
      legend: {
        position: 'bottom',
      },
      },
    }
    });

  </script>

@endpush