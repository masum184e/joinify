@extends('includes.layout')

@section('title', 'Joinify')
@section('sub-title', 'Browse Clubs')

@section('content')

  <!-- Page Header -->
  <section class="pt-32 pb-10 bg-gradient-to-b from-primary-50 to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
          <h1 class="text-4xl font-bold text-gray-900 font-poppins">Discover Campus Clubs</h1>
          <p class="text-xl text-gray-600 mt-2">Find your community and pursue your passions</p>
        </div>

        <!-- Search Form -->
        <form method="GET" action="" class="relative max-w-md w-full">
          <input type="text" 
                 name="search" 
                 value="{{ request('search') }}"
                 placeholder="Search clubs..."
                 class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all" />
          <i class="ri-search-line absolute left-4 top-3.5 text-gray-400 text-xl"></i>
          
          <!-- Hidden inputs to preserve other filters -->
          @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
          @endif
          @if(request('sort'))
            <input type="hidden" name="sort" value="{{ request('sort') }}">
          @endif
        </form>
      </div>

      <!-- Filter Tags -->
      <div class="flex flex-wrap gap-2 mt-6">
        @foreach($categories as $key => $label)
          <a href="{{ request()->fullUrlWithQuery(['category' => $key, 'page' => null]) }}" 
             class="px-4 py-2 rounded-full text-sm font-medium transition-all
                    {{ request('category', 'all') === $key 
                       ? 'bg-primary-600 text-white' 
                       : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
            {{ $label }}
          </a>
        @endforeach
      </div>

      <!-- Sort Options -->
      <div class="flex items-center gap-4 mt-4">
        <span class="text-sm text-gray-600">Sort by:</span>
        <div class="flex gap-2">
          <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'order' => 'desc', 'page' => null]) }}" 
             class="text-sm px-3 py-1 rounded-full {{ request('sort', 'created_at') === 'created_at' ? 'bg-primary-100 text-primary-700' : 'text-gray-600 hover:bg-gray-100' }}">
            Newest
          </a>
          <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'order' => 'asc', 'page' => null]) }}" 
             class="text-sm px-3 py-1 rounded-full {{ request('sort') === 'name' ? 'bg-primary-100 text-primary-700' : 'text-gray-600 hover:bg-gray-100' }}">
            Name
          </a>
          <a href="{{ request()->fullUrlWithQuery(['sort' => 'members', 'order' => 'desc', 'page' => null]) }}" 
             class="text-sm px-3 py-1 rounded-full {{ request('sort') === 'members' ? 'bg-primary-100 text-primary-700' : 'text-gray-600 hover:bg-gray-100' }}">
            Most Members
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Clubs Grid -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if($clubs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach($clubs as $club)
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover">
      <div class="h-48 bg-gradient-to-r from-primary-500 to-primary-700 relative">
      <img src="{{ $club->banner ? asset('storage/' . $club->banner) : 'https://placehold.co/400x200' }}"
      alt="{{ $club->name }}" class="w-full h-full object-cover mix-blend-overlay" />
      <div
      class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-primary-600 font-bold px-3 py-1 rounded-full text-sm">
      {{ $club->memberships->count() }} Members
      </div>
      </div>
      <div class="p-6">
      <div class="flex items-center mb-4">
      <!-- <div class="p-2 bg-primary-100 rounded-full">
      <i class="ri-camera-line text-xl text-primary-600"></i>
      </div> -->
      <h3 class="text-xl font-bold text-gray-900">
        {{ $club->name }}
      </h3>
      </div>
      <p class="text-gray-600 mb-6">{{ $club->description }}</p>
      <div class="flex justify-between items-center">
      <div class="flex -space-x-2">
        @if ($club->memberships->count() > 3)
      <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Member"
      class="w-8 h-8 rounded-full border-2 border-white" />
      <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Member"
      class="w-8 h-8 rounded-full border-2 border-white" />
      <img src="https://randomuser.me/api/portraits/women/48.jpg" alt="Member"
      class="w-8 h-8 rounded-full border-2 border-white" />
      <div
      class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs font-medium text-gray-500">
      +{{ $club->memberships->count() - 3 }}
      </div>
      @endif
      </div>

      <a href="/clubs/{{ $club->id }}"
        class="text-primary-600 font-semibold hover:text-primary-700 transition">View Club
        →</a>
      </div>
      </div>
      </div>
    @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
          {{ $clubs->appends(request()->query())->links('pagination::tailwind') }}
        </div>
      @else
        <!-- No Results -->
        <div class="text-center py-12">
          <div class="max-w-md mx-auto">
            <i class="ri-search-line text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No clubs found</h3>
            <p class="text-gray-600 mb-6">
              @if(request('search'))
                No clubs match your search for "{{ request('search') }}".
              @else
                No clubs are available in this category.
              @endif
            </p>
            <a href="{{ route('clubs.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
              <i class="ri-refresh-line mr-2"></i>
              View All Clubs
            </a>
          </div>
        </div>
      @endif
    </div>
  </section>

@endsection

@push('scripts')
<script>
  // Auto-submit search form on input (with debounce)
  let searchTimeout;
  document.querySelector('input[name="search"]').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
      this.form.submit();
    }, 500);
  });
</script>
@endpush