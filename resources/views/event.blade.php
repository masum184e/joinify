@extends('includes.layout')

@section('title', 'Environment Club')

@section('content')

  <!-- Event Header -->
  <section class="pt-32 pb-8 bg-gradient-to-b from-primary-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-center gap-6">
      <div class="flex-1">
      <div class="flex items-center gap-3 mb-4">
        <a href="public-events.html" class="text-primary-600 hover:text-primary-700 flex items-center">
        <i class="ri-arrow-left-line mr-1"></i>
        <span>Back to Events</span>
        </a>
        <span
        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
        Open Registration
        </span>
      </div>
      <h1 class="text-4xl font-bold text-gray-900 font-poppins mb-2">{{ $event->title }}</h1>
      <p class="text-lg text-gray-600">Join us for a relaxing walk through the beautiful botanical gardens as we
        capture the colors of spring.</p>

      <div class="flex flex-wrap gap-4 mt-6">
        <div class="flex items-center text-gray-700">
        <i class="ri-calendar-line mr-2 text-primary-600"></i>
        <span>May 15, 2023</span>
        </div>
        <div class="flex items-center text-gray-700">
        <i class="ri-time-line mr-2 text-primary-600"></i>
        <span>10:00 AM - 12:00 PM</span>
        </div>
        <div class="flex items-center text-gray-700">
        <i class="ri-map-pin-line mr-2 text-primary-600"></i>
        <span>{{ $event->location }}</span>
        </div>
      </div>
      </div>
      <div class="md:w-1/3">
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6">
        <div class="flex items-center justify-between mb-4">
          <div class="text-2xl font-bold text-gray-900">Free</div>
          <span
          class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
          42 attending
          </span>
        </div>

        <div class="space-y-4">
          <button type="button"
          class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium px-5 py-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
          Register Now
          </button>

          <button type="button"
          class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-5 py-3 rounded-lg shadow-sm hover:shadow transition-all duration-300">
          <i class="ri-calendar-line mr-2"></i>
          Add to Calendar
          </button>

          <div class="flex items-center justify-between text-sm text-gray-500">
          <span>Registration closes:</span>
          <span class="font-medium">May 14, 2023</span>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </section>

  <!-- Event Image -->
  <section class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="rounded-xl overflow-hidden shadow-sm">
      <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://placehold.co/400x200' }}"
      alt="{{ $event->title }}" class="w-full h-96 object-cover" />
    </div>
    </div>
  </section>

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
          <p class="mb-4">
          Join us for a relaxing walk through the beautiful University Botanical Gardens as we capture the colors
          of spring. This event is perfect for photographers of all skill levels, from beginners to advanced.
          </p>
          <p class="mb-4">
          The Botanical Gardens offer a diverse range of subjects to photograph, from vibrant flowers and plants
          to serene landscapes and architectural elements. This is a great opportunity to practice your
          composition skills, macro photography, and nature photography techniques.
          </p>
          <p class="mb-4">
          Our club president, Emily Johnson, will be leading the walk and providing tips and guidance throughout
          the session. You'll have the chance to learn from fellow photographers, share techniques, and get
          feedback on your work.
          </p>
          <h3 class="text-xl font-bold text-gray-900 font-poppins mt-6 mb-3">What to Bring</h3>
          <ul class="list-disc pl-5 mb-4">
          <li>Your camera (DSLR, mirrorless, or even a smartphone)</li>
          <li>Lenses (if you have them - wide angle and macro recommended)</li>
          <li>Tripod (optional but recommended)</li>
          <li>Extra batteries and memory cards</li>
          <li>Water and snacks</li>
          <li>Comfortable walking shoes</li>
          <li>Weather-appropriate clothing</li>
          </ul>
          <h3 class="text-xl font-bold text-gray-900 font-poppins mt-6 mb-3">Schedule</h3>
          <ul class="list-disc pl-5 mb-4">
          <li><strong>10:00 AM</strong> - Meet at the main entrance of the Botanical Gardens</li>
          <li><strong>10:15 AM</strong> - Brief introduction and photography tips</li>
          <li><strong>10:30 AM</strong> - Begin the photo walk</li>
          <li><strong>11:45 AM</strong> - Gather for sharing and feedback</li>
          <li><strong>12:00 PM</strong> - Event concludes</li>
          </ul>
          <p>
          After the event, we encourage participants to share their favorite photos on our club's online gallery.
          The best photos will be featured on our social media channels and may be selected for our end-of-year
          exhibition.
          </p>
        </div>
        </div>
      </div>

      <!-- Organizer -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-900 font-poppins mb-4">Organizer</h2>
        <div class="flex items-center">
          <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Emily Johnson"
          class="h-16 w-16 rounded-full mr-4">
          <div>
          <h3 class="text-lg font-medium text-gray-900">Emily Johnson</h3>
          <p class="text-gray-600">Photography Club President</p>
          <div class="mt-2">
            <a href="club-details.html"
            class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
            <i class="ri-information-line mr-1"></i>
            About the Club
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
          <div
            class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
            <i class="ri-calendar-line text-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-900">Date</p>
            <p class="text-sm text-gray-500">May 15, 2023</p>
          </div>
          </li>
          <li class="flex">
          <div
            class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
            <i class="ri-time-line text-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-900">Time</p>
            <p class="text-sm text-gray-500">10:00 AM - 12:00 PM</p>
          </div>
          </li>
          <li class="flex">
          <div
            class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
            <i class="ri-map-pin-line text-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-900">Location</p>
            <p class="text-sm text-gray-500">{{ $event->location }}</p>
          </div>
          </li>
          <li class="flex">
          <div
            class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
            <i class="ri-user-line text-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-900">Attendees</p>
            <p class="text-sm text-gray-500">42 registered / 50 capacity</p>
          </div>
          </li>
          <li class="flex">
          <div
            class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
            <i class="ri-price-tag-3-line text-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-900">Price</p>
            <p class="text-sm text-gray-500">Free</p>
          </div>
          </li>
          <li class="flex">
          <div
            class="flex-shrink-0 h-10 w-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center mr-3">
            <i class="ri-group-line text-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-900">Accessibility</p>
            <p class="text-sm text-gray-500">Open to all</p>
          </div>
          </li>
        </ul>

        <div class="mt-6 pt-6 border-t border-gray-200">
          <h3 class="text-lg font-medium text-gray-900 mb-3">Share This Event</h3>
          <div class="flex space-x-4">
          <a href="#" class="text-gray-400 hover:text-primary-600 transition">
            <i class="ri-facebook-fill text-xl"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-primary-600 transition">
            <i class="ri-twitter-fill text-xl"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-primary-600 transition">
            <i class="ri-instagram-fill text-xl"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-primary-600 transition">
            <i class="ri-linkedin-fill text-xl"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-primary-600 transition">
            <i class="ri-link text-xl"></i>
          </a>
          </div>
        </div>
        </div>
      </div>

      <!-- Similar Events -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6">
        <h2 class="text-lg font-bold text-gray-900 font-poppins mb-4">Similar Events</h2>
        <ul class="space-y-4">
          <li>
          <a href="public-event-details.html"
            class="flex items-center hover:bg-gray-50 p-2 rounded-lg transition-colors">
            <div class="flex-shrink-0 h-14 w-14 bg-primary-100 rounded-lg overflow-hidden mr-3">
            <img
              src="https://images.unsplash.com/photo-1542038784456-1ea8e935640e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80"
              alt="Portrait Photography Workshop" class="h-full w-full object-cover">
            </div>
            <div>
            <p class="text-sm font-medium text-gray-900">Portrait Photography Workshop</p>
            <p class="text-xs text-gray-500">May 22, 2023</p>
            </div>
          </a>
          </li>
          <li>
          <a href="public-event-details.html"
            class="flex items-center hover:bg-gray-50 p-2 rounded-lg transition-colors">
            <div class="flex-shrink-0 h-14 w-14 bg-primary-100 rounded-lg overflow-hidden mr-3">
            <img
              src="https://images.unsplash.com/photo-1493863641943-9b68992a8d07?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80"
              alt="Night Photography Basics" class="h-full w-full object-cover">
            </div>
            <div>
            <p class="text-sm font-medium text-gray-900">Night Photography Basics</p>
            <p class="text-xs text-gray-500">June 20, 2023</p>
            </div>
          </a>
          </li>
          <li>
          <a href="public-event-details.html"
            class="flex items-center hover:bg-gray-50 p-2 rounded-lg transition-colors">
            <div class="flex-shrink-0 h-14 w-14 bg-primary-100 rounded-lg overflow-hidden mr-3">
            <img
              src="https://images.unsplash.com/photo-1452587925148-ce544e77e70d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80"
              alt="Lightroom Editing Masterclass" class="h-full w-full object-cover">
            </div>
            <div>
            <p class="text-sm font-medium text-gray-900">Lightroom Editing Masterclass</p>
            <p class="text-xs text-gray-500">June 12, 2023</p>
            </div>
          </a>
          </li>
        </ul>
        <div class="mt-4 text-center">
          <a href="public-events.html" class="text-sm font-medium text-primary-600 hover:text-primary-700">
          View All Events
          </a>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-16 bg-gradient-to-r from-primary-600 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl font-bold font-poppins mb-4">Join Our Photography Club</h2>
    <p class="text-lg text-primary-100 max-w-3xl mx-auto mb-8">Connect with fellow photography enthusiasts, learn new
      skills, and showcase your work. Membership includes access to equipment, workshops, and exclusive events.</p>
    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <a href="join-club.html"
      class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-primary-700 bg-white hover:bg-primary-50 shadow-lg hover:shadow-xl transition-all duration-300">
      Become a Member
      </a>
    </div>
    </div>
  </section>


@endsection