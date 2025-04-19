@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Accountant')

@section('layout-title', 'Club Accountant')
@section('layout-sub-title', 'Manage your club\'s events and members efficiently.')

@section('content')
    <div class="mb-8">
        <!-- Search & Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-end pb-4 pt-2">
            <div class="relative w-full md:w-64">
                <input type="text" id="memberSearch" placeholder="Search member..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
                <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 pointer-events-none" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </div>
        </div>

        <!-- Member Table -->
        <div class="bg-white shadow-xl rounded-2xl overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold tracking-wider">Payment Date</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold tracking-wider">Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-700">
                    <!-- Example Member Row -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-blue-700 whitespace-nowrap">
                            <a href="/dashboard/members/0" class="hover:underline">Sarah Johnson</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">sarah@example.com</td>
                        <td class="px-6 py-4 whitespace-nowrap">Jan 15, 2024</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <span
                                class="inline-block bg-blue-100 text-blue-700 px-3 py-1 text-xs font-semibold rounded-full shadow-sm">
                                $50
                            </span>
                        </td>

                    </tr>

                    <!-- Add more member rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
@endsection