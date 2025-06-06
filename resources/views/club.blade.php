@extends('includes.layout')

@section('title', $club->name)
@section('sub-title', 'Joinify')

@section('content')
  <!-- Club Header -->
  <section class="pt-32 pb-10 bg-gradient-to-b from-primary-50 to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row gap-8">
      <div class="md:w-2/3">
      <div class="flex items-center gap-3 mb-4">
        <a href="/clubs" class="text-primary-600 hover:text-primary-700 flex items-center">
        <i class="ri-arrow-left-line mr-1"></i>
        <span>All Clubs</span>
        </a>
        <span class="text-gray-400">•</span>
        <span class="text-gray-600">{{ $club->name }}</span>
      </div>
      <h1 class="text-4xl font-bold text-gray-900 font-poppins mb-4">{{ $club->name }}</h1>

      <div class="flex flex-wrap gap-3 mb-6">
        <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-medium">Arts</span>
        <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-medium">Creative</span>
        <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-medium">Visual Media</span>
      </div>

      <div class="flex flex-wrap gap-6 mb-8">
        <div class="flex items-center">
        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-3">
          <i class="ri-calendar-line"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Founded</p>
          <p class="font-medium">{{ \Carbon\Carbon::parse($club->created_at)->format('M d, Y') }}</p>
        </div>
        </div>

        <div class="flex items-center">
        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-3">
          <i class="ri-team-line"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Members</p>
          <p class="font-medium">{{ $club->memberships->count() }} Students</p>
        </div>
        </div>

        <div class="flex items-center">
        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-3">
          <i class="ri-money-dollar-circle-line"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Membership Fee</p>
          <p class="font-medium">৳{{ $club->fee }}/month</p>
        </div>
        </div>
      </div>


      <!-- About Section -->
      <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 font-poppins">About Our Club</h2>
        <p class="text-gray-600 mb-4">{{ $club->description }}</p>
      </div>

      <!-- Upcoming Events -->
      @if($club->events->count() > 0)
      <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 font-poppins">Upcoming Events</h2>


        @foreach($club->events->take(5) as $event)
      <div class="border-b border-gray-100 pb-6 mb-6">
      <div class="flex items-start gap-4">
        <div
        class="min-w-16 w-16 h-16 bg-primary-100 rounded-lg flex flex-col items-center justify-center text-primary-600">
        <span class="text-lg font-bold">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
        <span class="text-sm">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
        </div>
        <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $event->title }}</h3>
        <div class="flex items-center text-sm text-gray-500">
        <i class="ri-time-line mr-1"></i>
        <span>{{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} -
                                {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</span>
        <span class="mx-2">•</span>
        <i class="ri-map-pin-line mr-1"></i>
        <span>{{ $event->location }}</span>
        </div>
        </div>
      </div>
      </div>
      @endforeach

        <div class="mt-6 text-center">
        <a href="/clubs/{{ $club->id }}/events"
        class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
        View All Events
        <i class="ri-arrow-right-line ml-1"></i>
        </a>
        </div>
      </div>
    @endif

      </div>

      <div class="md:w-1/3">
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 mb-8">
        <div class="h-48 bg-gradient-to-r from-primary-500 to-primary-700 relative">
        <img src="{{ $club->banner ? asset('storage/' . $club->banner) : 'https://placehold.co/400x200' }}"
          alt="{{ $club->name }}" class="w-full h-full object-cover mix-blend-overlay" />
        </div>
        <div class="p-6">
        <a href="/clubs/{{ $club->id }}/join"
          class="block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-xl text-center shadow-lg hover:shadow-xl transition-all duration-300 mb-4">
          Join This Club
        </a>

        </div>
      </div>

      <!-- Club Leadership -->
      <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6 font-poppins">Club Leadership</h2>

        <!-- President -->
        <div class="flex items-center gap-2 mb-6">
        <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">
          <span class="text-blue-600 font-bold">{{ substr($club->president?->user?->name, 0, 1) }}</span>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900">{{ $club->president?->user?->name }}</h3>
          <p class="text-primary-600 text-sm">President</p>
          <p class="text-gray-500 text-sm">{{ $club->president?->user?->email }}</p>
        </div>
        </div>

        <!-- Secretary -->
        <div class="flex items-center gap-2 mb-6">
        <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">
          <span class="text-blue-600 font-bold">{{ substr($club->secretary?->user?->name, 0, 1) }}</span>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900">{{ $club->secretary?->user?->name }}</h3>
          <p class="text-primary-600 text-sm">Secretary</p>
          <p class="text-gray-500 text-sm">{{ $club->secretary?->user?->email }}</p>
        </div>
        </div>

        <!-- Accountant -->
        <div class="flex items-center gap-2">
        <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">
          <span class="text-blue-600 font-bold">{{ substr($club->accountant?->user?->name, 0, 1) }}</span>
        </div>
        <div>
          <h3 class="font-semibold text-gray-900">{{ $club->accountant?->user?->name }}</h3>
          <p class="text-primary-600 text-sm">Accountant</p>
          <p class="text-gray-500 text-sm">{{ $club->accountant?->user?->email }}</p>
        </div>
        </div>
      </div>

  <!-- Similar Clubs -->
                @if($similarClubs->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 font-poppins flex items-center">
                            <i class="ri-links-line text-primary-600 mr-2"></i>
                            Similar Clubs
                        </h3>

                        <div class="space-y-4">
                            @foreach($similarClubs as $similarClub)
                                <a href="/clubs/{{ $similarClub->id }}" class="block p-4 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-primary-400 to-purple-500 rounded-lg flex items-center justify-center text-white font-bold mr-3">
                                            {{ substr($similarClub->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $similarClub->name }}</h4>
                                            <p class="text-gray-500 text-sm">{{ $similarClub->memberships_count }} members</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif


      </div>
    </div>
    </div>
  </section>

  <!-- Club Content -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    </div>
  </section>
@endsection