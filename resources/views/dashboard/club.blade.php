@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Club Advisor')
@section('layout-sub-title', 'Manage your club, track events, and oversee member activities.')

@section('content')

    <!-- Admin/Advisor Club Details Page -->
    <div class="mb-8">
        <!-- Club Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight flex items-center gap-2">
                {{ $club->name }}
            </h1>
            <a href="/dashboard/clubs/{{ $club->id }}/edit"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-xl shadow-md transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5h10M11 9h7M11 13h4M4 6h.01M4 10h.01M4 14h.01M4 18h.01" />
                </svg>
                Edit
            </a>
        </div>


        <!-- Description -->
        <p class="text-gray-700 text-base mb-6 leading-relaxed">
            {{ $club->description }}
        </p>

        <!-- Club Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Created At -->
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-xl shadow-sm">
                <h2 class="font-semibold text-gray-600 text-sm uppercase mb-1">Created At</h2>
                <p class="text-lg font-bold text-gray-800">{{ \Carbon\Carbon::parse($club->created_at)->format('M d, Y') }}
                </p>
            </div>

            <!-- Total Members -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl shadow-sm">
                <h2 class="font-semibold text-blue-700 text-sm uppercase mb-1">Total Members</h2>
                <p class="text-xl font-extrabold text-blue-900">{{ $club->memberships->count() }}</p>
            </div>

            <!-- Revenue -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl shadow-sm">
                <h2 class="font-semibold text-green-700 text-sm uppercase mb-1">Revenue</h2>
                <p class="text-xl font-extrabold text-green-900">৳{{ $clubRevenue }}</p>
            </div>

            <!-- Status -->
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 p-4 rounded-xl shadow-sm">
                <h2 class="font-semibold text-emerald-700 text-sm uppercase mb-1">Status</h2>
                @if ($club->president?->verified == 1 && $club->secretary?->verified == 1 && $club->accountant?->verified == 1)
                    <span class="inline-block px-3 py-1 rounded-full bg-green-200 text-green-800 font-semibold text-sm">
                        Active
                    </span>
                @else
                    <span class="inline-block px-3 py-1 rounded-full bg-red-200 text-red-800 font-semibold text-sm">
                        Inactive
                    </span>
                @endif

            </div>
        </div>


        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Executive Members</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                <!-- President -->
                <div
                    class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
                    <div class="mb-2 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-blue-900">President</h3>
                        <div class="bg-white p-2 rounded-full shadow text-blue-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0a1 1 0 00.95.69h1.518c.969 0 1.371 1.24.588 1.81l-1.23.89a1 1 0 00-.364 1.118l.47 1.45c.3.921-.755 1.688-1.54 1.118l-1.23-.89a1 1 0 00-1.176 0l-1.23.89c-.785.57-1.84-.197-1.54-1.118l.47-1.45a1 1 0 00-.364-1.118l-1.23-.89c-.783-.57-.38-1.81.588-1.81h1.518a1 1 0 00.95-.69z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 14.25c-4.97 0-9 2.012-9 4.5V21h18v-2.25c0-2.488-4.03-4.5-9-4.5z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-900 font-semibold">{{ $club->president?->user?->name }} </p>
                    <p class="text-sm text-gray-700">{{ $club->president?->user?->email }}</p>
                </div>

                <!-- Secretary -->
                <div
                    class="bg-gradient-to-br from-indigo-100 to-indigo-200 p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
                    <div class="mb-2 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-indigo-900">Secretary</h3>
                        <div class="bg-white p-2 rounded-full shadow text-indigo-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-900 font-semibold">{{ $club->secretary?->user?->name }}</p>
                    <p class="text-sm text-gray-700">{{ $club->secretary?->user?->email }}</p>
                </div>

                <!-- Accountant -->
                <div
                    class="bg-gradient-to-br from-green-100 to-green-200 p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
                    <div class="mb-2 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-green-900">Accountant</h3>
                        <div class="bg-white p-2 rounded-full shadow text-green-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8c-1.105 0-2 .672-2 1.5S10.895 11 12 11s2 .672 2 1.5S13.105 14 12 14s-2 .672-2 1.5S10.895 17 12 17m0-9v1m0 8v1m0-10a9 9 0 110 18 9 9 0 010-18z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-900 font-semibold">{{ $club->accountant?->user?->name }}</p>
                    <p class="text-sm text-gray-700">{{ $club->accountant?->user?->email }}</p>
                </div>

            </div>
        </div>



        <div class="mt-12">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                    Club Members
                </h2>

                <!-- Search Box -->
                <div class="relative">
                    <input type="text" id="memberSearch" placeholder="Search members..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 pointer-events-none" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white shadow-xl rounded-2xl overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-50 to-emerald-50 text-blue-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold tracking-wider">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold tracking-wider">Joined Date</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold tracking-wider">Membership</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-700">
                        @foreach ($club->memberships as $membership)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-blue-700 whitespace-nowrap">
                                    <a href="/members/{{ $membership->id }}"
                                        class="hover:underline">{{ $membership->member->user->name }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $membership->member->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($membership->payment->created_at)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($membership->payment->payment_status == 'paid')
                                    <span
                                        class="inline-block bg-green-100 text-green-700 px-3 py-1 text-xs font-semibold rounded-full shadow-sm">
                                       Paid
                                    </span>                                    
                                    @else
                                    <span
                                        class="inline-block bg-red-100 text-red-700 px-3 py-1 text-xs font-semibold rounded-full shadow-sm">
                                       Pending
                                    </span>                                    
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>



    </div>
@endsection