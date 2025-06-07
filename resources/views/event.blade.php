@extends('includes.layout')

@section('title', $event->title )
@section('sub-title', $event->club->name)
@section('content')

  <!-- Event Header -->
  <section class="pt-32 pb-8 bg-gradient-to-b from-primary-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row md:items-center gap-6">
        <div class="flex-1">
          <div class="flex items-center gap-3 mb-4">
            <a href="/clubs/{{ $event->club->id }}/events" class="text-primary-600 hover:text-primary-700 flex items-center">
              <i class="ri-arrow-left-line mr-1"></i>
              <span>Back to Events</span>
            </a>
          </div>
          
          <h1 class="text-4xl font-bold text-gray-900 font-poppins mb-2">{{ $event->title }}</h1>
          <p class="text-lg text-gray-600">{{ $event->short_description ?? Str::limit($event->description, 120) }}</p>

          <div class="flex flex-wrap gap-4 mt-6">
            <div class="flex items-center text-gray-700">
              <i class="ri-calendar-line mr-2 text-primary-600"></i>
              <span>{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</span>
            </div>
            <div class="flex items-center text-gray-700">
              <i class="ri-time-line mr-2 text-primary-600"></i>
              <span>{{ \Carbon\Carbon::parse($event->event_date)->format('g:i A') }}
                @if($event->end_time)
                  - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                @endif
              </span>
            </div>
            <div class="flex items-center text-gray-700">
              <i class="ri-map-pin-line mr-2 text-primary-600"></i>
              <span>{{ $event->location }}</span>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>

  <!-- Event Image -->
  @if($event->poster)
    <section class="py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-xl overflow-hidden shadow-sm">
          <img src="{{ asset('storage/' . $event->poster) }}"
               alt="{{ $event->title }}" 
               class="w-full h-96 object-cover" />
        </div>
      </div>
    </section>
  @endif

  <!-- Event Details -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
          <!-- About the Event -->
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="p-6">
              <h2 class="text-2xl font-bold text-gray-900 font-poppins mb-4">About the Event</h2>
              <div class="prose max-w-none text-gray-600">
                {!! nl2br(e($event->description)) !!}
              </div>
              
              @if($event->requirements)
                <div class="mt-6">
                  <h3 class="text-xl font-bold text-gray-900 font-poppins mb-3">Requirements</h3>
                  <div class="prose max-w-none text-gray-600">
                    {!! nl2br(e($event->requirements)) !!}
                  </div>
                </div>
              @endif
            </div>
          </div>

          <!-- Organizer -->
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6">
              <h2 class="text-2xl font-bold text-gray-900 font-poppins mb-4">Organizer</h2>
              <div class="flex items-center">
                <img src="{{ $event->organizer?->avatar ?? $event->club->president?->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($event->club->name) . '&background=random' }}" 
                     alt="{{ $event->organizer?->name ?? $event->club->president?->name ?? $event->club->name }}"
                     class="h-16 w-16 rounded-full mr-4">
                <div>
                  <h3 class="text-lg font-medium text-gray-900">
                    {{ $event->organizer?->name ?? $event->club->president?->name ?? $event->club->name }}
                  </h3>
                  <p class="text-gray-600">
                    {{ $event->organizer ? 'Event Organizer' : ($event->club->president ? $event->club->name . ' President' : $event->club->name) }}
                  </p>
                  <div class="mt-2">
                    <a href="{{ route('clubs.show', $event->club->id) }}"
                       class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                      <i class="ri-information-line mr-1"></i>
                      About {{ $event->club->name }}
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="lg:col-span-1">
          <!-- Event Details Sidebar -->
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8 sticky top-24">
            <div class="p-6">
              <h2 class="text-lg font-bold text-gray-900 font-poppins mb-4">Event Details</h2>
              <ul class="space-y-4">
                <li class="flex">
                  <div class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="ri-calendar-line text-lg"></i>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900">Date</p>
                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</p>
                  </div>
                </li>
                <li class="flex">
                  <div class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="ri-time-line text-lg"></i>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900">Time</p>
                    <p class="text-sm text-gray-500">
                      {{ \Carbon\Carbon::parse($event->event_date)->format('g:i A') }}
                      @if($event->end_time)
                        - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                      @endif
                    </p>
                  </div>
                </li>
                <li class="flex">
                  <div class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="ri-map-pin-line text-lg"></i>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900">Location</p>
                    <p class="text-sm text-gray-500">{{ $event->location }}</p>
                  </div>
                </li>
                <li class="flex">
                  <div class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="ri-user-line text-lg"></i>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900">Attendees</p>
                  </div>
                </li>
                <li class="flex">
                  <div class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="ri-price-tag-3-line text-lg"></i>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900">Price</p>
                    <p class="text-sm text-gray-500">
                      @if($event->price > 0)
                        ${{ number_format($event->price, 2) }}
                      @else
                        Free
                      @endif
                    </p>
                  </div>
                </li>
                <li class="flex">
                  <div class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="ri-group-line text-lg"></i>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900">Hosted by</p>
                    <p class="text-sm text-gray-500">{{ $event->club->name }}</p>
                  </div>
                </li>
              </ul>

              <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Share This Event</h3>
                <div class="flex space-x-4">
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                     target="_blank" class="text-gray-400 hover:text-primary-600 transition">
                    <i class="ri-facebook-fill text-xl"></i>
                  </a>
                  <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($event->title) }}" 
                     target="_blank" class="text-gray-400 hover:text-primary-600 transition">
                    <i class="ri-twitter-fill text-xl"></i>
                  </a>
                  <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                     target="_blank" class="text-gray-400 hover:text-primary-600 transition">
                    <i class="ri-linkedin-fill text-xl"></i>
                  </a>
                  <button onclick="copyToClipboard('{{ request()->fullUrl() }}')" 
                          class="text-gray-400 hover:text-primary-600 transition">
                    <i class="ri-link text-xl"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Similar Events -->
          @if($similarEvents->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
              <div class="p-6">
                <h2 class="text-lg font-bold text-gray-900 font-poppins mb-4">More from {{ $event->club->name }}</h2>
                <ul class="space-y-4">
                  @foreach($similarEvents as $similarEvent)
                    <li>
                      <a href="{{ route('events.show', [$similarEvent->club_id, $similarEvent->id]) }}"
                         class="flex items-center hover:bg-gray-50 p-2 rounded-lg transition-colors">
                        <div class="flex-shrink-0 h-14 w-14 bg-primary-100 rounded-lg overflow-hidden mr-3">
                          @if($similarEvent->poster)
                            <img src="{{ asset('storage/' . $similarEvent->poster) }}" 
                                 alt="{{ $similarEvent->title }}" 
                                 class="h-full w-full object-cover">
                          @else
                            <div class="h-full w-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                              <i class="ri-calendar-event-line text-white text-xl"></i>
                            </div>
                          @endif
                        </div>
                        <div>
                          <p class="text-sm font-medium text-gray-900">{{ Str::limit($similarEvent->title, 40) }}</p>
                          <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($similarEvent->event_date)->format('M j, Y') }}</p>
                        </div>
                      </a>
                    </li>
                  @endforeach
                </ul>
                <div class="mt-4 text-center">
                  <a href="{{ route('events.index', ['club' => $event->club_id]) }}" 
                     class="text-sm font-medium text-primary-600 hover:text-primary-700">
                    View All Events
                  </a>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-16 bg-gradient-to-r from-primary-600 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl font-bold font-poppins mb-4">Join {{ $event->club->name }}</h2>
      <p class="text-lg text-primary-100 max-w-3xl mx-auto mb-8">
        Connect with fellow members, participate in events, and be part of our community.
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="/clubs/{{ $event->club->id }}/join"
           class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-primary-700 bg-white hover:bg-primary-50 shadow-lg hover:shadow-xl transition-all duration-300">
          Become a Member
        </a>
      </div>
    </div>
  </section>

@endsection

@push('scripts')
<script>
function addToCalendar() {
  const event = {
    title: "{{ $event->title }}",
    start: "{{ \Carbon\Carbon::parse($event->event_date)->format('Ymd\THis') }}",
    end: "{{ $event->end_time ? \Carbon\Carbon::parse($event->end_time)->format('Ymd\THis') : \Carbon\Carbon::parse($event->event_date)->addHours(2)->format('Ymd\THis') }}",
    location: "{{ $event->location }}",
    description: "{{ strip_tags($event->description) }}"
  };
  
  const url = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(event.title)}&dates=${event.start}/${event.end}&location=${encodeURIComponent(event.location)}&details=${encodeURIComponent(event.description)}`;
  window.open(url, '_blank');
}

function copyToClipboard(text) {
  navigator.clipboard.writeText(text).then(() => {
    alert('Link copied to clipboard!');
  });
}

// Show success/error messages
@if(session('success'))
  setTimeout(() => {
    alert('{{ session('success') }}');
  }, 100);
@endif

@if(session('error'))
  setTimeout(() => {
    alert('{{ session('error') }}');
  }, 100);
@endif
</script>
@endpush