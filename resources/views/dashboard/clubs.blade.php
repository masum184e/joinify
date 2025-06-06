@extends('dashboard.includes.layout')

@section('title', 'Clubs Management')
@section('sub-title', 'Advisor')

@section('layout-title', 'Club Management')
@section('layout-sub-title', 'Manage university clubs, track activities, and oversee operations.')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="ri-building-line text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Clubs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_clubs'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="ri-check-line text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Active Clubs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['active_clubs'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <i class="ri-group-line text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Members</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_members']) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <i class="ri-calendar-event-line text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Events</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_events']) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 mb-8">
        <form method="GET" action="{{ route('clubs.index') }}" class="space-y-4">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <!-- Search -->
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search clubs by name or description..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <i class="ri-search-line absolute left-3 top-2.5 text-gray-400"></i>
                    </div>
                </div>

                <!-- Filters -->
                <div class="flex items-center space-x-4">
                    <!-- Status Filter -->
                    <select name="status" 
                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>

                    <!-- Sort By -->
                    <select name="sort" 
                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>Date Created</option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name</option>
                        <option value="members" {{ request('sort') === 'members' ? 'selected' : '' }}>Members</option>
                        <option value="events" {{ request('sort') === 'events' ? 'selected' : '' }}>Events</option>
                        <option value="fee" {{ request('sort') === 'fee' ? 'selected' : '' }}>Fee</option>
                    </select>

                    <!-- Sort Order -->
                    <select name="order" 
                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Descending</option>
                        <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Ascending</option>
                    </select>

                    <!-- Filter Button -->
                    <button type="submit" 
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="ri-filter-line mr-2"></i>
                        Filter
                    </button>

                    <!-- Clear Filters -->
                    @if(request()->hasAny(['search', 'status', 'sort', 'order']))
                        <a href="{{ route('clubs.index') }}" 
                           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Clear
                        </a>
                    @endif
                </div>

                <!-- Create Club Button -->
                <a href="{{ route('clubs.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="ri-add-line mr-2"></i>
                    Create New Club
                </a>
            </div>
        </form>
    </div>

    <!-- Clubs Grid -->
    @if($clubs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($clubs as $club)
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <!-- Club Banner -->
                    <div class="relative h-48 bg-gray-200">
                        @if($club->banner)
                            <img src="{{ asset('storage/' . $club->banner) }}" 
                                 alt="{{ $club->name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                <i class="ri-building-line text-white text-4xl"></i>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3">
                            @if($club->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="ri-check-line mr-1"></i>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="ri-time-line mr-1"></i>
                                    Pending
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Club Info -->
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $club->name }}</h3>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <span class="flex items-center">
                                    <i class="ri-group-line mr-1"></i>
                                    {{ $club->memberships_count }} members
                                </span>
                                <span class="flex items-center">
                                    <i class="ri-calendar-event-line mr-1"></i>
                                    {{ $club->events_count }} events
                                </span>
                                <span class="flex items-center">
                                    <i class="ri-money-dollar-circle-line mr-1"></i>
                                    ৳{{ number_format($club->fee) }}/month
                                </span>
                            </div>
                        </div>

                        <!-- Executive Status -->
                        <div class="mb-4">
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $roles = [
                                        'president' => $club->president,
                                        'secretary' => $club->secretary,
                                        'accountant' => $club->accountant
                                    ];
                                @endphp
                                
                                @foreach($roles as $roleName => $role)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $role?->verified ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        @if($role?->verified)
                                            <i class="ri-check-line mr-1"></i>
                                        @else
                                            <i class="ri-close-line mr-1"></i>
                                        @endif
                                        {{ ucfirst($roleName) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <a href="{{ route('clubs.show', $club->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="ri-eye-line mr-2"></i>
                                View Details
                            </a>

                            <div class="flex items-center space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('clubs.edit', $club->id) }}" 
                                   class="inline-flex items-center p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors"
                                   title="Edit Club">
                                    <i class="ri-edit-line"></i>
                                </a>

                                <!-- Delete Button -->
                                <button onclick="confirmDelete({{ $club->id }})" 
                                        class="inline-flex items-center p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                        title="Delete Club">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Showing {{ $clubs->firstItem() }} to {{ $clubs->lastItem() }} of {{ $clubs->total() }} clubs
            </div>
            {{ $clubs->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-12 text-center">
            <i class="ri-building-line text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No clubs found</h3>
            @if(request()->hasAny(['search', 'status']))
                <p class="text-gray-500 mb-6">No clubs match your current filters. Try adjusting your search criteria.</p>
                <a href="{{ route('clubs.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                    Clear Filters
                </a>
            @else
                <p class="text-gray-500 mb-6">Get started by creating your first university club.</p>
                <a href="{{ route('clubs.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                    <i class="ri-add-circle-line mr-2"></i>
                    Create Your First Club
                </a>
            @endif
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <i class="ri-alert-line text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Club</h3>
            <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete this club? This action cannot be undone and will remove all associated data including members, events, and transactions.</p>
            <div class="flex justify-center space-x-3">
                <button onclick="closeDeleteModal()" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none">
                        Delete Club
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg z-50" id="success-message">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-md shadow-lg z-50" id="error-message">
        {{ session('error') }}
    </div>
@endif

<script>
function confirmDelete(clubId) {
    document.getElementById('deleteForm').action = `/dashboard/clubs/${clubId}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Auto-hide success/error messages
setTimeout(function() {
    const successMsg = document.getElementById('success-message');
    const errorMsg = document.getElementById('error-message');
    if (successMsg) successMsg.style.display = 'none';
    if (errorMsg) errorMsg.style.display = 'none';
}, 5000);
</script>
@endsection