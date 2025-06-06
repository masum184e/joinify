@extends('dashboard.includes.layout')

@section('title', $club->name)
@section('sub-title', 'Joinify')

@section('layout-title', 'Club Management')
@section('layout-sub-title', 'View and manage club information')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Breadcrumb and Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4 sm:mb-0">
            <a href="{{ route('clubs.index') }}" class="hover:text-gray-700 flex items-center">
                <i class="ri-arrow-left-line mr-1"></i>
                Back to Clubs
            </a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="text-gray-900 font-medium">{{ $club->name }}</span>
        </nav>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('clubs.edit', $club->id) }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="ri-edit-line mr-2"></i>
                Edit Club
            </a>
        </div>
    </div>

    <!-- Club Status Banner -->
    @if(!$stats['is_active'])
        <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-6">
            <div class="flex items-center">
                <i class="ri-alert-line text-yellow-400 mr-3"></i>
                <div>
                    <h3 class="text-sm font-medium text-yellow-800">Club Inactive</h3>
                    <p class="text-sm text-yellow-700">Some executive positions are not verified. Please ensure all executives have verified their accounts.</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Hero Section -->
    <div class="relative mb-8 rounded-lg overflow-hidden">
        @if($club->banner)
            <img src="{{ asset('storage/' . $club->banner) }}" 
                 alt="{{ $club->name }}" 
                 class="w-full h-64 object-cover">
        @else
            <div class="w-full h-64 bg-gradient-to-br from-blue-400 to-purple-500"></div>
        @endif
        
        <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/70 to-transparent text-white">
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $club->name }}</h1>
                    <div class="flex items-center space-x-4 text-white/90">
                        <span class="flex items-center">
                            <i class="ri-group-line mr-1"></i>
                            {{ $stats['total_members'] }} members
                        </span>
                        <span class="flex items-center">
                            <i class="ri-calendar-event-line mr-1"></i>
                            {{ $stats['total_events'] }} events
                        </span>
                        <span class="flex items-center">
                            <i class="ri-money-dollar-circle-line mr-1"></i>
                            ৳{{ number_format($club->fee, 2) }}/month
                        </span>
                    </div>
                </div>
                
                <div class="text-right">
                    @if($stats['is_active'])
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="ri-check-line mr-1"></i>
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <i class="ri-alert-line mr-1"></i>
                            Inactive
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button class="tab-btn py-2 px-1 border-b-2 font-medium text-sm border-blue-500 text-blue-600" 
                            data-tab="about">
                        About
                    </button>
                    <button class="tab-btn py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" 
                            data-tab="events">
                        Events
                    </button>
                    <button class="tab-btn py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" 
                            data-tab="members">
                        Members
                    </button>
                    <button class="tab-btn py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" 
                            data-tab="transactions">
                        Transactions
                    </button>
                </nav>
            </div>

            <!-- About Tab -->
            <div id="about" class="tab-content">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">About the Club</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 mb-6">{{ $club->description }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center text-sm">
                                    <i class="ri-calendar-line text-gray-400 mr-3"></i>
                                    <span class="text-gray-600">Created:</span>
                                    <span class="ml-2 font-medium">{{ $stats['created_at']->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <i class="ri-group-line text-gray-400 mr-3"></i>
                                    <span class="text-gray-600">Total Members:</span>
                                    <span class="ml-2 font-medium">{{ $stats['total_members'] }}</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <i class="ri-user-check-line text-gray-400 mr-3"></i>
                                    <span class="text-gray-600">Active Members:</span>
                                    <span class="ml-2 font-medium">{{ $stats['active_members'] }}</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center text-sm">
                                    <i class="ri-calendar-event-line text-gray-400 mr-3"></i>
                                    <span class="text-gray-600">Total Events:</span>
                                    <span class="ml-2 font-medium">{{ $stats['total_events'] }}</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <i class="ri-calendar-todo-line text-gray-400 mr-3"></i>
                                    <span class="text-gray-600">Upcoming Events:</span>
                                    <span class="ml-2 font-medium">{{ $stats['upcoming_events'] }}</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <i class="ri-money-dollar-circle-line text-gray-400 mr-3"></i>
                                    <span class="text-gray-600">Membership Fee:</span>
                                    <span class="ml-2 font-medium">৳{{ number_format($club->fee, 2) }}/month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Tab -->
            <div id="events" class="tab-content hidden">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Events</h3>
                            <a href="{{ route('events.index', $club->id) }}" 
                               class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                View All Events
                            </a>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($club->events as $event)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900 mb-2">{{ $event->title }}</h4>
                                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($event->description, 120) }}</p>
                                        
                                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                                            <span class="flex items-center">
                                                <i class="ri-calendar-line mr-1"></i>
                                                {{ Carbon\Carbon::parse($event->date)->format('M j, Y') }}
                                            </span>
                                            <span class="flex items-center">
                                                <i class="ri-time-line mr-1"></i>
                                                {{ Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
                                            </span>
                                            <span class="flex items-center">
                                                <i class="ri-map-pin-line mr-1"></i>
                                                {{ $event->location }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="ml-4 text-right">
                                        @if(Carbon\Carbon::parse($event->date)->isFuture())
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Upcoming
                                            </span>
                                        @elseif(Carbon\Carbon::parse($event->date)->isToday())
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Today
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Completed
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-500">
                                <i class="ri-calendar-line text-4xl mb-4"></i>
                                <p class="text-lg font-medium mb-2">No events yet</p>
                                <p class="text-sm">This club hasn't organized any events.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Members Tab -->
            <div id="members" class="tab-content hidden">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Club Members</h3>
                            <span class="text-sm text-gray-500">{{ $stats['total_members'] }} total members</span>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($club->memberships as $membership)
                            <div class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-medium">
                                            {{ substr($membership->member->user->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $membership->member->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $membership->member->user->email }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center space-x-4">
                                        @php
                                            $statusClass = match($membership->status) {
                                                'active' => 'bg-green-100 text-green-800',
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'inactive' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                            {{ ucfirst($membership->status) }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            Joined: {{ $membership->created_at->format('M j, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-500">
                                <i class="ri-user-line text-4xl mb-4"></i>
                                <p class="text-lg font-medium mb-2">No members yet</p>
                                <p class="text-sm">This club doesn't have any members.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Transactions Tab -->
            <div id="transactions" class="tab-content hidden">
                <div class="space-y-6">
                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <i class="ri-arrow-up-line text-green-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600">Total Income</p>
                                    <p class="text-2xl font-bold text-gray-900">৳{{ number_format($monthlyData['total_income']) }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex items-center">
                                <div class="p-2 bg-red-100 rounded-lg">
                                    <i class="ri-arrow-down-line text-red-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600">Total Expenses</p>
                                    <p class="text-2xl font-bold text-gray-900">৳{{ number_format($monthlyData['total_expenses']) }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <i class="ri-wallet-line text-blue-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600">Net Income</p>
                                    <p class="text-2xl font-bold text-gray-900">৳{{ number_format($monthlyData['net_income']) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Monthly Transactions</h3>
                        </div>
                        <div class="p-6">
                            <canvas id="transactionChart" class="w-full" style="max-height: 400px;"></canvas>
                        </div>
                    </div>

                    <!-- Recent Transactions -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Transactions</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach($recentTransactions as $transaction)
                                <div class="p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="p-2 rounded-lg {{ $transaction['type'] === 'income' ? 'bg-green-100' : 'bg-red-100' }}">
                                                <i class="ri-{{ $transaction['type'] === 'income' ? 'arrow-up' : 'arrow-down' }}-line {{ $transaction['type'] === 'income' ? 'text-green-600' : 'text-red-600' }}"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $transaction['description'] }}</p>
                                                <p class="text-sm text-gray-500">{{ $transaction['date']->format('M j, Y') }}</p>
                                            </div>
                                        </div>
                                        <p class="font-semibold {{ $transaction['type'] === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $transaction['type'] === 'income' ? '+' : '-' }}৳{{ number_format(abs($transaction['amount'])) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Club Leadership -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Club Leadership</h3>
                </div>
                <div class="p-6 space-y-4">
                    <!-- President -->
                    <div class="flex items-center space-x-3">
                        <div class="h-12 w-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center font-medium">
                            <i class="ri-crown-line"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">{{ $club->president?->user?->name ?? 'Not assigned' }}</p>
                            <p class="text-sm text-gray-500">President</p>
                            @if($club->president?->user?->email)
                                <p class="text-sm text-gray-500">{{ $club->president->user->email }}</p>
                            @endif
                        </div>
                        @if($club->president?->verified)
                            <i class="ri-check-line text-green-500"></i>
                        @else
                            <i class="ri-time-line text-yellow-500"></i>
                        @endif
                    </div>

                    <!-- Secretary -->
                    <div class="flex items-center space-x-3">
                        <div class="h-12 w-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-medium">
                            <i class="ri-file-text-line"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">{{ $club->secretary?->user?->name ?? 'Not assigned' }}</p>
                            <p class="text-sm text-gray-500">Secretary</p>
                            @if($club->secretary?->user?->email)
                                <p class="text-sm text-gray-500">{{ $club->secretary->user->email }}</p>
                            @endif
                        </div>
                        @if($club->secretary?->verified)
                            <i class="ri-check-line text-green-500"></i>
                        @else
                            <i class="ri-time-line text-yellow-500"></i>
                        @endif
                    </div>

                    <!-- Accountant -->
                    <div class="flex items-center space-x-3">
                        <div class="h-12 w-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-medium">
                            <i class="ri-calculator-line"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">{{ $club->accountant?->user?->name ?? 'Not assigned' }}</p>
                            <p class="text-sm text-gray-500">Accountant</p>
                            @if($club->accountant?->user?->email)
                                <p class="text-sm text-gray-500">{{ $club->accountant->user->email }}</p>
                            @endif
                        </div>
                        @if($club->accountant?->verified)
                            <i class="ri-check-line text-green-500"></i>
                        @else
                            <i class="ri-time-line text-yellow-500"></i>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Stats</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Active Members</span>
                        <span class="font-semibold text-gray-900">{{ $stats['active_members'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Pending Members</span>
                        <span class="font-semibold text-yellow-600">{{ $stats['pending_members'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Upcoming Events</span>
                        <span class="font-semibold text-blue-600">{{ $stats['upcoming_events'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Past Events</span>
                        <span class="font-semibold text-gray-600">{{ $stats['past_events'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    let chartInitialized = false;

    // Tab switching
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active classes
            tabs.forEach(t => {
                t.classList.remove('border-blue-500', 'text-blue-600');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            tabContents.forEach(tc => tc.classList.add('hidden'));

            // Add active classes
            tab.classList.remove('border-transparent', 'text-gray-500');
            tab.classList.add('border-blue-500', 'text-blue-600');
            
            const tabId = tab.dataset.tab;
            document.getElementById(tabId).classList.remove('hidden');

            // Initialize chart when transactions tab is shown
            if (tabId === 'transactions' && !chartInitialized) {
                initializeChart();
                chartInitialized = true;
            }
        });
    });

    function initializeChart() {
        const ctx = document.getElementById('transactionChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyData['labels']) !!},
                datasets: [
                    {
                        label: 'Income',
                        data: {!! json_encode($monthlyData['income']) !!},
                        backgroundColor: '#10b981',
                        borderRadius: 4,
                    },
                    {
                        label: 'Expenses',
                        data: {!! json_encode($monthlyData['expenses']) !!},
                        backgroundColor: '#ef4444',
                        borderRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '৳' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }

    // Auto-hide messages
    setTimeout(function() {
        const successMsg = document.getElementById('success-message');
        const errorMsg = document.getElementById('error-message');
        if (successMsg) successMsg.style.display = 'none';
        if (errorMsg) errorMsg.style.display = 'none';
    }, 5000);
});


</script>
@endsection