@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Club Advisor')
@section('layout-sub-title', 'Manage your club, track events, and oversee member activities.')

@section('content')
    <div class="mb-10">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">👤 Member Information</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div>
                <h3 class="text-sm text-gray-500">Full Name</h3>
                <p class="text-lg font-semibold text-gray-800">{{ $member->user->name }}</p>
            </div>

            <!-- Student ID -->
            <div>
                <h3 class="text-sm text-gray-500">Student ID</h3>
                <p class="text-lg font-semibold text-gray-800">{{ $member->student_id }}</p>
            </div>

            <!-- Email -->
            <div>
                <h3 class="text-sm text-gray-500">Email</h3>
                <p class="text-lg font-semibold text-gray-800">{{ $member->user->email }}</p>
            </div>

            <!-- Department -->
            <div>
                <h3 class="text-sm text-gray-500">Department</h3>
                <p class="text-lg font-semibold text-gray-800">{{ $member->department }}</p>
            </div>
        </div>

        <!-- Club Memberships -->
        <div class="mt-6">
            <h2 class="text-xl font-bold text-gray-800">🌟 Member Of</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach ($member->memberships as $membership)
                    <div
                        class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl shadow-md p-5 hover:shadow-lg transition">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-600 text-white p-3 rounded-full mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a8 8 0 00-8 8h16a8 8 0 00-8-8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-blue-700">{{ $membership->club->name }}</h3>
                                <p class="text-sm text-blue-600">Member</p>
                                <!-- You can update this if you have a role field -->
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection