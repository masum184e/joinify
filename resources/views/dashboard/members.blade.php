@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Accountant')

@section('layout-title', 'Member Management')
@section('layout-sub-title', 'Manage your club members and their information')

@section('content')
    <div class="mb-8">
        <!-- Member Stats -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
            <!-- Total Members -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-primary-100 rounded-md p-3">
                            <i class="ri-user-line text-primary-600 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Members</dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">{{ $stats['total'] }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Members -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                            <i class="ri-user-follow-line text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Active Members</dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">{{ $stats['active'] }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New This Month -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <i class="ri-user-add-line text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">New This Month</dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">{{ $stats['new_this_month'] }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                            <i class="ri-time-line text-yellow-600 text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Pending Approvals</dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">{{ $stats['pending'] }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Member Management -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div
                class="px-4 py-5 sm:px-6 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Members</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">View and manage all club members</p>
                </div>
                <!-- Search & Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-end pb-4 pt-2 space-x-2">
                    <form method="GET" action="" class="relative w-full md:w-64">
                        <input type="text" name="search" id="memberSearch" placeholder="Search member..."
                            value="{{ $search }}"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 pointer-events-none" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                    </form>
                    <a href="/dashboard/clubs/{{ $clubId }}/members/export"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i class="ri-download-line mr-2"></i>
                        Export CSV
                    </a>
                </div>
            </div>

            <!-- Member List -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Member</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Member Since
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Membership Fee
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($members as $member)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $member->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $member->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $payment = $member->memberships->first()->payment ?? null;
                                        $status = $payment ? $payment->payment_status : 'inactive';
                                        $statusClass = match ($status) {
                                            'paid' => 'bg-green-100 text-green-800',
                                            'completed' => 'bg-green-100 text-yellow-800',
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'failed' => 'bg-red-100 text-red-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    {{ $member->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    @php
                                        $paymentAmount = $payment ? $payment->amount : 0;
                                    @endphp
                                    <span
                                        class="inline-block bg-blue-100 text-blue-700 px-3 py-1 text-xs font-semibold rounded-full shadow-sm">
                                        ৳{{ number_format($paymentAmount, 2) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    @if($search)
                                        No members found matching "{{ $search }}"
                                    @else
                                        No members found
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($members->hasPages())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        @if($members->previousPageUrl())
                            <a href="{{ $members->previousPageUrl() }}"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Previous
                            </a>
                        @endif
                        @if($members->nextPageUrl())
                            <a href="{{ $members->nextPageUrl() }}"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Next
                            </a>
                        @endif
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">{{ $members->firstItem() }}</span> to
                                <span class="font-medium">{{ $members->lastItem() }}</span> of
                                <span class="font-medium">{{ $members->total() }}</span> members
                            </p>
                        </div>
                        <div>
                            {{ $members->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Auto-submit search form on input
        document.getElementById('memberSearch').addEventListener('input', function () {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
    </script>
@endsection