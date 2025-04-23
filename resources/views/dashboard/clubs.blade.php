@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Student Advisor')
@section('layout-sub-title', 'Manage your club\'s events and members efficiently.')

@section('content')
    <div class="mb-8">
        <!-- Search & Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between pb-4 gap-4 pt-2">

            <!-- Create Club Button -->
            <a href="/dashboard/clubs/create"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition duration-300">
                Create New Club
            </a>

            <!-- Search Box -->
            <div class="relative w-full md:w-64">
                <input type="text" id="clubSearch" placeholder="Search club..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
                <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 pointer-events-none" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </div>

        </div>

        <div class="bg-white shadow-xl rounded-2xl overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold tracking-wider">President</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold tracking-wider">Members</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-700">

                    @foreach($clubs as $club)

                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-blue-700">
                                <a href="/dashboard/clubs/{{ $club->id }}" class="hover:underline">{{ $club->name }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $club->president?->user?->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $club->userRoles->count() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-1">
                                @foreach($club->userRoles as $role)
                                    <span class="badge">
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $role->verified ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            @if($role->verified)

                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            @else
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @endif
                                            {{ ucfirst($role->role) }}
                                        </span>
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-3">
                                <!-- Edit Icon -->
                                <a href="/dashboard/clubs/{{ $club->id }}/edit"
                                    class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-indigo-100 hover:bg-indigo-200 transition"
                                    title="Edit Club">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.232 5.232l3.536 3.536M9 11l-1 4 4-1 7.071-7.071a2 2 0 00-2.828-2.828L9 11z" />
                                    </svg>
                                </a>

                                <!-- Remove Icon -->
                                <form method="POST" action="{{ url('/dashboard/clubs/' . $club->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Remove Club"
                                        onclick="return confirm('Are you sure you want to delete this club?')"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-100 hover:bg-red-200 transition">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14" />
                                        </svg>
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

@endsection