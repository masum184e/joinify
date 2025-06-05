@extends('dashboard.includes.layout')

@section('title', 'President Dashboard')
@section('sub-title', $club->name)

@section('layout-title', 'Accountant Dashboard')
@section('layout-sub-title', 'Financial overview and transaction management')

@section('content')
    <div class="space-y-5 mb-8">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg border border-border p-4 shadow-sm">
                <div class="flex items-center justify-between pb-2">
                    <h3 class="text-sm font-medium">Total Revenue</h3>
                    <i class="ri-money-dollar-circle-line text-gray-500"></i>
                </div>
                <div class="text-2xl font-bold">৳{{ number_format($totalRevenue, 2) }}</div>
                <div class="text-xs text-textgray-500">Total collected</div>
            </div>

            <div class="bg-white rounded-lg border border-border p-4 shadow-sm">
                <div class="flex items-center justify-between pb-2">
                    <h3 class="text-sm font-medium">Total Expenses</h3>
                    <i class="ri-bar-chart-grouped-line text-gray-500"></i>
                </div>
                <div class="text-2xl font-bold">৳{{ number_format($totalExpenses, 2) }}</div>
                <div class="text-xs text-gray-500">Year to date</div>
            </div>

            <div class="bg-white rounded-lg border border-border p-4 shadow-sm">
                <div class="flex items-center justify-between pb-2">
                    <h3 class="text-sm font-medium">Net Balance</h3>
                    <i class="ri-bubble-chart-line text-gray-500"></i>
                </div>
                <div class="text-2xl font-bold text-{{ $remainingBalance >= 0 ? 'green' : 'red' }}-600">
                    ৳{{ number_format($remainingBalance, 2) }}
                </div>
                <div class="text-xs text-gray-500">Available funds</div>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-8">
            <div class="bg-white rounded-lg border border-border shadow-sm">
                <div class="p-4 border-b border-border">
                    <div class="flex items-center">
                        <i class="ri-bar-chart-line mr-2 "></i>
                        <h3 class="font-medium">Monthly Revenue</h3>
                    </div>
                    <p class="text-sm text-gray-500">Revenue trends over the past 12 months</p>
                </div>
                <div class="p-4">
                    @if(count($chartData) > 0)
                        <div class="h-80">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    @else
                        <div class="h-80 flex items-center justify-center text-gray-500">
                            <div class="text-center">
                                <i class="ri-bar-chart-line text-4xl mb-2"></i>
                                <p>No revenue data available</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-lg border border-border shadow-sm">
                <div class="p-4 border-b border-border">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="ri-bank-card-line mr-2 "></i>
                            <h3 class="font-medium">Recent Transactions</h3>
                        </div>
                        <span class="text-sm text-gray-500">{{ $recentTransactions->count() }} transactions</span>
                    </div>
                    <p class="text-sm text-gray-500">Latest membership payments</p>
                </div>
                <div class="p-4">
                    @if($recentTransactions->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentTransactions as $transaction)
                                <div class="flex items-center justify-between border-b pb-3 last:border-0">
                                    <div class="space-y-1">
                                        <p class="text-sm font-medium leading-none">
                                            {{ $transaction->membership->member->user->name ?? 'Unknown Member' }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($transaction->paid_at)->format('M d, Y \a\t g:i A') }}
                                        </p>
                                        @if($transaction->transaction_id)
                                            <p class="text-xs text-gray-500">
                                                ID: {{ $transaction->transaction_id }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <div class="font-medium text-green-600">
                                            ৳{{ number_format($transaction->amount, 2) }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ ucfirst($transaction->payment_status) }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="ri-bank-card-line text-4xl mb-2"></i>
                            <p>No recent transactions</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @if(count($chartData) > 0)
        // Revenue Chart with actual data
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Revenue (৳)',
                    data: @json($chartData),
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#4f46e5',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return `Revenue: ৳${context.raw.toLocaleString()}`;
                            }
                        }
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '৳' + value.toLocaleString();
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
        @endif
    </script>
@endpush