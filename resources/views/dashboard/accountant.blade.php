@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Accountant')

@section('layout-title', 'Club Accountant')
@section('layout-sub-title', 'Manage your club\'s events and members efficiently.')

@section('content')
    <div class="space-y-5 mb-8">

        <!-- Financial Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Budget -->
            <div class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 rounded-2xl shadow-lg border-l-4 border-blue-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-blue-700 uppercase">Total Budget</h2>
                        <p class="text-3xl font-extrabold text-blue-900 mt-1">{{ $totalRevenue }}</p>
                    </div>
                    <div class="bg-blue-500 text-white rounded-full p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8c-1.657 0-3 1.343-3 3h6c0-1.657-1.343-3-3-3z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 2v2m0 16v2m8-10h2m-18 0H2m15.364-6.364l1.414 1.414M4.222 19.778l1.414-1.414M4.222 4.222l1.414 1.414M18.364 18.364l1.414-1.414" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Expenses -->
            <div class="bg-gradient-to-br from-red-100 to-red-200 p-6 rounded-2xl shadow-lg border-l-4 border-red-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-red-700 uppercase">Expenses</h2>
                        <p class="text-3xl font-extrabold text-red-900 mt-1">{{ $totalExpenses }}</p>
                    </div>
                    <div class="bg-red-500 text-white rounded-full p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Remaining -->
            <div
                class="bg-gradient-to-br from-green-100 to-green-200 p-6 rounded-2xl shadow-lg border-l-4 border-green-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-green-700 uppercase">Remaining</h2>
                        <p class="text-3xl font-extrabold text-green-900 mt-1">{{ $remainingBalance }}</p>
                    </div>
                    <div class="bg-green-500 text-white rounded-full p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="md:col-span-2 bg-gradient-to-br from-green-50 to-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <h3 class="text-xl font-bold text-green-800 flex items-center gap-2 mb-4">
                📊 Revenue Overview
            </h3>
            <div
                class="bg-white h-48 rounded-lg flex items-center justify-center text-gray-400 border-2 border-dashed border-green-100">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800 mb-5">💳 Recent Transactions</h2>

            <div class="overflow-x-auto rounded-xl">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-50 uppercase text-xs font-medium text-gray-500">
                        <tr>
                            <th class="px-5 py-3">Date</th>
                            <th class="px-5 py-3">Description</th>
                            <th class="px-5 py-3">Type</th>
                            <th class="px-5 py-3 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($recentTransactions as $transaction)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-3"> {{ \Carbon\Carbon::parse($transaction->paid_at)->format('M d, Y') }}</td>
                                <td class="px-5 py-3"> {{ $transaction->membership->member->user->name ?? 'Unknown' }}</td>
                                <td class="px-5 py-3">
                                    <span
                                        class="inline-block px-2 py-1 rounded-full bg-red-100 text-green-600 text-xs font-medium">Income</span>
                                </td>
                                <td class="px-5 py-3 text-right font-semibold text-red-600">
                                ৳{{ number_format($transaction->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');

        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json(array_keys($revenueOverview)),
                datasets: [{
                    label: 'Revenue ($)',
                    data: @json(array_values($revenueOverview)),
                    fill: true,
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush