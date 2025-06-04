@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Student Advisor')
@section('layout-sub-title', 'Manage your club\'s events and members efficiently.')

@section('content')
  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-card rounded-lg border border-border p-4 shadow-sm">
    <div class="flex items-center justify-between pb-2">
      <h3 class="text-sm font-medium">Total Clubs</h3>
      <i class="ri-group-line text-muted-foreground"></i>
    </div>
    <div class="text-2xl font-bold">{{ $clubCount }}</div>
    <div class="text-xs text-muted-foreground">Across all departments</div>
    </div>

    <div class="bg-card rounded-lg border border-border p-4 shadow-sm">
    <div class="flex items-center justify-between pb-2">
      <h3 class="text-sm font-medium">Total Members</h3>
      <i class="ri-user-line text-muted-foreground"></i>
    </div>
    <div class="text-2xl font-bold">{{ $memberCount }}</div>
    <div class="text-xs text-muted-foreground">Active student members</div>
    </div>

    <div class="bg-card rounded-lg border border-border p-4 shadow-sm">
    <div class="flex items-center justify-between pb-2">
      <h3 class="text-sm font-medium">Total Revenue</h3>
      <i class="ri-money-dollar-circle-line text-muted-foreground"></i>
    </div>
    <div class="text-2xl font-bold">৳{{ number_format($totalRevenue, 2) }}</div>
    <div class="text-xs text-muted-foreground">From membership fees</div>
    </div>

    <div class="bg-card rounded-lg border border-border p-4 shadow-sm">
    <div class="flex items-center justify-between pb-2">
      <h3 class="text-sm font-medium">Net Balance</h3>
      <i class="ri-money-dollar-circle-line text-muted-foreground"></i>
    </div>
    <div class="text-2xl font-bold">৳{{ number_format($netBalance, 2) }}</div>
    <div class="text-xs text-muted-foreground">After expenses</div>
    </div>
  </div>

  <!-- Charts -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-card rounded-lg border border-border shadow-sm">
    <div class="p-4 border-b border-border">
      <div class="flex items-center">
      <i class="ri-bar-chart-line mr-2 h-4 w-4"></i>
      <h3 class="font-medium">Club Membership & Revenue</h3>
      </div>
      <p class="text-sm text-muted-foreground">Top 5 clubs by membership and revenue</p>
    </div>
    <div class="p-4">
      <div class="h-80">
      <canvas id="barChart"></canvas>
      </div>
    </div>
    </div>

    <div class="bg-card rounded-lg border border-border shadow-sm">
    <div class="p-4 border-b border-border">
      <div class="flex items-center">
      <i class="ri-pie-chart-line mr-2 h-4 w-4"></i>
      <h3 class="font-medium">Membership Distribution</h3>
      </div>
      <p class="text-sm text-muted-foreground">Distribution of members across top clubs</p>
    </div>
    <div class="p-4">
      <div class="h-80">
      <canvas id="pieChart"></canvas>
      </div>
    </div>
    </div>
  </div>

  <!-- Lists -->
  <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
    <div class="bg-card rounded-lg border border-border shadow-sm">
    <div class="p-4 border-b border-border">
      <div class="flex items-center justify-between">
      <h3 class="font-medium">Popular Clubs</h3>
      <a href="/dashboard/clubs" class="text-sm text-primary flex items-center gap-1">
        View all
        <i class="ri-arrow-right-s-line"></i>
      </a>
      </div>
      <p class="text-sm text-muted-foreground">Top performing clubs by membership</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($popularClubs as $club)
      <div class="relative {{ $loop->first ? '' : 'border-l' }} p-4">
      <div class="flex items-center justify-between mb-4 ">
      <h3 class="text-lg font-bold text-gray-800"><a href="/dashboard/clubs/{{ $club->id }}">{{ $club->name }}</a></h3>
      @if ($loop->first)
      <span
      class="absolute top-4 right-2 animate-pulse text-xs bg-green-600 text-white px-2 py-1 rounded-full z-10">Top
      Club</span>
      @else
      <span
      class="absolute top-4 right-2 text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full z-10">#{{ $loop->iteration }}</span>

      @endif
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
      <div class="text-base font-semibold text-gray-700">৳{{ $club->fee }}</div>
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
      <div class="text-base font-semibold text-green-600">৳{{ $club->revenue }}</div>
      <div class="text-xs text-gray-400 mt-1">Revenue</div>
      </div>
      </div>
      </div>
    @endforeach
    </div>

    </div>

  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>

    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
      labels: @json(array_keys($clubsMemberCount)),
      datasets: [
      {
        label: 'Members',
        data: @json(array_values($clubsMemberCount)),
        backgroundColor: '#8884d8',
        yAxisID: 'y',
      },
      {
        label: 'Revenue ($)',
        data: @json(array_values($clubsRevenueData)),
        backgroundColor: '#82ca9d',
        yAxisID: 'y1',
      }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
      y: {
        type: 'linear',
        position: 'left',
      },
      y1: {
        type: 'linear',
        position: 'right',
        grid: {
        drawOnChartArea: false,
        },
      }
      }
    }
    });

    // Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
      labels: @json(array_keys($clubRevenue)),
      datasets: [{
      data: @json(array_values($clubRevenue)),
      backgroundColor: [
        '#8884d8',
        '#82ca9d',
        '#ffc658',
        '#ff8042',
        '#0088fe'
      ],
      borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
      legend: {
        position: 'right',
      }
      }
    }
    });

  </script>

@endpush