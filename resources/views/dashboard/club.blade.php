@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Club Advisor')
@section('layout-sub-title', 'Manage your club, track events, and oversee member activities.')

@section('content')
    <div class="flex justify-between mb-2">
        <a href="/dashboard/clubs"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700  font-medium px-4 py-2 rounded-md transition-all duration-300">
            <i class="ri-arrow-left-line mr-2"></i>
            Back to Clubs
        </a>
        <a href="/dashboard/clubs/{{ $club->id }}/edit"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md shadow-md transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11 5h10M11 9h7M11 13h4M4 6h.01M4 10h.01M4 14h.01M4 18h.01" />
            </svg>
            Edit
        </a>
    </div>

    <div class="relative mb-8">
        <img src="{{ $club->banner ? asset('storage/' . $club->banner) : 'https://placehold.co/400x200' }}"
            alt="{{ $club->name }}" class="w-full h-64 object-cover rounded-lg">
        <div
            class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/60 to-transparent text-white rounded-b-lg">
            <h1 class="text-3xl font-bold">{{ $club->name }}</h1>
            <p class="text-white/80">
                {{ $club->memberships->count() }} members • ৳{{ $club->fee }}/month
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-2">
        <di v class="lg:col-span-2">
            <!-- Tabs -->
            <div class="flex space-x-4 border-b mb-4">
                <button class="tab-btn text-sm font-medium py-2 px-4 border-b-2 border-transparent hover:border-blue-500"
                    data-tab="about">About</button>
                <button class="tab-btn text-sm font-medium py-2 px-4 border-b-2 border-transparent hover:border-blue-500"
                    data-tab="events">Events</button>
                <button class="tab-btn text-sm font-medium py-2 px-4 border-b-2 border-transparent hover:border-blue-500"
                    data-tab="members">Members</button>
                <button class="tab-btn text-sm font-medium py-2 px-4 border-b-2 border-transparent hover:border-blue-500"
                    data-tab="transactions">Transactions</button>
            </div>

            <!-- About Tab Content -->
            <div id="about" class="tab-content block space-y-6">
                <div class="bg-white rounded-lg shadow border">
                    <div class="p-4 border-b">
                        <h3 class="font-medium text-lg">About the Club</h3>
                    </div>
                    <div class="p-4 text-gray-700">
                        <p>{{ $club->description }}</p>
                        <div class="grid grid-cols-2 gap-4 mt-6 text-sm">
                            <div class="flex items-center gap-2">
                                <i class="ri-calendar-line text-gray-500"></i>Created:
                                {{ \Carbon\Carbon::parse($club->created_at)->format('M d, Y') }}
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="ri-user-line text-gray-500"></i>{{ $club->memberships->count() }} Members
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="ri-money-dollar-circle-line text-gray-500"></i>Fee: ৳{{ $club->fee }}/month
                            </div>
                            <div class="flex items-center gap-2">
                                @if ($club->president?->verified == 1 && $club->secretary?->verified == 1 && $club->accountant?->verified == 1)
                                    <span
                                        class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                        Active
                                    </span>
                                @else
                                    <span
                                        class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Tab Content -->
            <div id="events" class="tab-content block space-y-6">
                <div class="bg-white rounded-lg shadow border">
                    <div class="p-4 border-b">
                        <h3 class="font-medium text-lg">Upcoming Events</h3>
                    </div>
                    <!-- Event Item 1 -->
                    <div class="border-b p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between">
                            <h4 class="font-medium">Annual Club Meeting</h4>
                            <span class="text-sm text-gray-500">May 20, 2025</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Join us for our annual club meeting where we'll discuss
                            achievements and future plans.</p>
                        <div class="mt-3 flex items-center gap-3">
                            <div class="flex items-center gap-1 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Conference Room A
                            </div>
                            <div class="flex items-center gap-1 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                24 attendees
                            </div>
                            <div class="flex items-center gap-1 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                2:00 PM - 4:00 PM
                            </div>
                        </div>
                    </div>

                    <!-- Event Item 2 -->
                    <div class="border-b p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between">
                            <h4 class="font-medium">Workshop: Leadership Skills</h4>
                            <span class="text-sm text-gray-500">May 25, 2025</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">A workshop focused on developing essential leadership skills
                            for
                            club members.</p>
                        <div class="mt-3 flex items-center gap-3">
                            <div class="flex items-center gap-1 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Training Room B
                            </div>
                            <div class="flex items-center gap-1 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                18 attendees
                            </div>
                            <div class="flex items-center gap-1 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                10:00 AM - 12:00 PM
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members Tab Content -->
            <div id="members" class="tab-content block space-y-6">
                <div class="bg-white rounded-lg shadow border">
                    <div class="p-4 border-b">
                        <h3 class="font-medium text-lg">Club Members</h3>
                    </div>
                    <!-- Member Item 1 -->
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-md transition-colors">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-medium">
                                JD
                            </div>
                            <div>
                                <p class="font-medium">John Doe</p>
                                <p class="text-sm text-gray-500">john.doe@example.com</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span
                                class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                Active
                            </span>
                            <span class="text-sm text-gray-500">Joined: Jan 15, 2025</span>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Member Item 2 -->
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-md transition-colors">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-medium">
                                RJ
                            </div>
                            <div>
                                <p class="font-medium">Robert Johnson</p>
                                <p class="text-sm text-gray-500">robert.johnson@example.com</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span
                                class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                Pending
                            </span>
                            <span class="text-sm text-gray-500">Joined: Apr 10, 2025</span>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Tab Content -->
            <div id="transactions" class="tab-content block space-y-6">
                <div class="bg-white rounded-lg shadow border">
                    <div class="p-4 border-b">
                        <h3 class="font-medium text-lg">Club Members</h3>
                    </div>
                    <div class="p-4">
                        <!-- Summary Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-500">Total Revenue</p>
                                <p class="text-2xl font-bold">৳12,450</p>
                                <p class="text-xs text-green-600 mt-1">+15% from previous month</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-500">Total Expenses</p>
                                <p class="text-2xl font-bold">৳4,280</p>
                                <p class="text-xs text-red-600 mt-1">+8% from previous month</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-500">Net Income</p>
                                <p class="text-2xl font-bold">৳8,170</p>
                                <p class="text-xs text-green-600 mt-1">+18% from previous month</p>
                            </div>
                        </div>

                        <!-- Graph -->
                        <div class="mb-6">
                            <h4 class="font-medium mb-4">Monthly Transactions</h4>
                            <canvas id="transactionChart" class="w-full max-h-80"></canvas>

                            <!-- Legend -->
                            <div class="flex items-center justify-center gap-6 mt-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-blue-500 rounded-sm"></div>
                                    <span class="text-xs text-gray-600">Income</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-red-400 rounded-sm"></div>
                                    <span class="text-xs text-gray-600">Expenses</span>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Transactions -->
                        <div>
                            <h4 class="font-medium mb-3">Recent Transactions</h4>
                            <div class="space-y-2">
                                <!-- Transaction 1 -->
                                <div class="flex justify-between items-center p-2 border-b">
                                    <div>
                                        <p class="font-medium">Membership Fees</p>
                                        <p class="text-sm text-gray-500">May 12, 2025</p>
                                    </div>
                                    <p class="font-medium text-green-600">+৳1,200</p>
                                </div>

                                <!-- Transaction 2 -->
                                <div class="flex justify-between items-center p-2 border-b">
                                    <div>
                                        <p class="font-medium">Event Supplies</p>
                                        <p class="text-sm text-gray-500">May 10, 2025</p>
                                    </div>
                                    <p class="font-medium text-red-600">-৳350</p>
                                </div>

                                <!-- Transaction 3 -->
                                <div class="flex justify-between items-center p-2 border-b">
                                    <div>
                                        <p class="font-medium">Workshop Registration</p>
                                        <p class="text-sm text-gray-500">May 8, 2025</p>
                                    </div>
                                    <p class="font-medium text-green-600">+৳800</p>
                                </div>

                                <!-- Transaction 4 -->
                                <div class="flex justify-between items-center p-2 border-b">
                                    <div>
                                        <p class="font-medium">Venue Rental</p>
                                        <p class="text-sm text-gray-500">May 5, 2025</p>
                                    </div>
                                    <p class="font-medium text-red-600">-৳500</p>
                                </div>

                                <!-- Transaction 5 -->
                                <div class="flex justify-between items-center p-2">
                                    <div>
                                        <p class="font-medium">Sponsorship</p>
                                        <p class="text-sm text-gray-500">May 1, 2025</p>
                                    </div>
                                    <p class="font-medium text-green-600">+৳2,000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </di>

        <div class="bg-white rounded-lg shadow border h-min">
            <div class="p-4 border-b">
                <h3 class="font-medium text-lg">Club Leadership</h3>
            </div>
            <div class="p-4 space-y-4">
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                        {{ substr($club->president?->user?->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-medium">{{ $club->president?->user?->name }}</p>
                        <p class="text-sm text-gray-500">President</p>
                        <p class="text-sm text-gray-500"><i
                                class="ri-mail-line mr-1"></i>{{ $club->president?->user?->email }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                        {{ substr($club->secretary?->user?->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-medium">{{ $club->secretary?->user?->name }}</p>
                        <p class="text-sm text-gray-500">Secretary</p>
                        <p class="text-sm text-gray-500"><i
                                class="ri-mail-line mr-1"></i>{{ $club->secretary?->user?->email }}u
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                        {{ substr($club->accountant?->user?->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-medium">{{ $club->accountant?->user?->name }}</p>
                        <p class="text-sm text-gray-500">Accountant</p>
                        <p class="text-sm text-gray-500"><i
                                class="ri-mail-line mr-1"></i>{{ $club->accountant?->user?->email }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        let transactionChartInitialized = false;

        // Set up tab switching logic
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active classes from all tabs
                tabs.forEach(t => t.classList.remove('border-blue-500', 'text-blue-600'));
                tabContents.forEach(tc => tc.classList.add('hidden'));

                // Activate clicked tab and content
                tab.classList.add('border-blue-500', 'text-blue-600');
                const tabId = tab.dataset.tab;
                const targetContent = document.getElementById(tabId);
                targetContent.classList.remove('hidden');

                // Initialize the chart if the Transactions tab is shown
                if (tabId === 'transactions' && !transactionChartInitialized) {
                    initializeTransactionChart();
                    transactionChartInitialized = true;
                }
            });
        });

        // Click the first tab by default
        tabs[0].click();

        function initializeTransactionChart() {
            const canvas = document.getElementById('transactionChart');
            if (!canvas) {
                console.error('Canvas with id "transactionChart" not found.');
                return;
            }

            const ctx = canvas.getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [
                        {
                            label: 'Income',
                            data: [3000, 4500, 6000, 7500],
                            backgroundColor: '#3b82f6'
                        },
                        {
                            label: 'Expenses',
                            data: [1500, 2000, 2500, 3000],
                            backgroundColor: '#f87171'
                        }
                    ]
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
        }
    });
</script>
@endpush
