@extends('includes.layout')

@section('title', 'Joinify')
@section('sub-title', 'Find Your People. Fuel Your Passion')

@section('content')
  <!-- Hero Section -->
  <section class="pt-32 pb-20 md:pt-40 md:pb-32 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-radial from-primary-100 to-transparent opacity-70 -z-10"></div>

    <!-- Animated Shapes -->
    <div
    class="absolute top-20 right-10 w-64 h-64 bg-primary-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow">
    </div>
    <div
    class="absolute bottom-10 left-10 w-64 h-64 bg-secondary-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow">
    </div>
    <div
    class="absolute top-40 left-1/4 w-64 h-64 bg-accent-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="flex flex-col lg:flex-row items-center gap-12">
      <div class="lg:w-1/2 text-center lg:text-left">
      <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold leading-tight mb-6">
        <span class="bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-500 text-gradient">Manage. Connect.
        Thrive.</span>
      </h1>
      <p class="text-xl md:text-2xl text-gray-700 mb-8 max-w-2xl mx-auto lg:mx-0">
        The ultimate platform for campus clubs to organize, connect, and grow their communities with powerful tools.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
        <a href="/clubs"
        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-4 rounded-xl shadow-glow hover:shadow-lg transform hover:scale-105 transition-all duration-300">
        Get Started Free
        </a>
        <a href="/events"
        class="bg-white text-primary-600 border border-primary-200 hover:border-primary-300 font-semibold px-8 py-4 rounded-xl shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center justify-center">
        <i class="ri-calendar-event-line mr-2 text-xl"></i>
        Events
        </a>
      </div>
      <div class="mt-10 flex items-center justify-center lg:justify-start">
        <div class="flex -space-x-3">
        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User"
          class="w-10 h-10 rounded-full border-2 border-white">
        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User"
          class="w-10 h-10 rounded-full border-2 border-white">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User"
          class="w-10 h-10 rounded-full border-2 border-white">
        <img src="https://randomuser.me/api/portraits/men/29.jpg" alt="User"
          class="w-10 h-10 rounded-full border-2 border-white">
        <div
          class="w-10 h-10 rounded-full bg-primary-100 border-2 border-white flex items-center justify-center text-xs font-medium text-primary-600">
          +5k
        </div>
        </div>
        <p class="ml-4 text-gray-600">
        <span class="font-semibold">5,000+</span> students trust Joinify
        </p>
      </div>
      </div>
      <div class="lg:w-1/2 relative">
      <div class="absolute -top-10 -left-10 w-40 h-40 bg-primary-200 rounded-full opacity-50 animate-float"></div>
      <div class="absolute -bottom-5 -right-5 w-32 h-32 bg-secondary-200 rounded-full opacity-50 animate-float"
        style="animation-delay: 1s;"></div>

      <div
        class="relative z-10 bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100 transform rotate-1 hover:rotate-0 transition-all duration-500">
        <div class="h-12 bg-gray-50 border-b border-gray-100 flex items-center px-4">
        <div class="flex space-x-2">
          <div class="w-3 h-3 rounded-full bg-red-400"></div>
          <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
          <div class="w-3 h-3 rounded-full bg-green-400"></div>
        </div>
        </div>
        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80"
        alt="Dashboard Preview" class="w-full h-auto" />
      </div>

      <!-- Floating Elements -->
      <div class="absolute top-1/4 -right-10 bg-white rounded-xl shadow-lg p-4 transform rotate-6 animate-float"
        style="animation-delay: 2s;">
        <div class="flex items-center space-x-3">
        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
          <i class="ri-user-add-line"></i>
        </div>
        <div>
          <p class="text-sm font-semibold text-gray-800">New Member</p>
          <p class="text-xs text-gray-500">Just now</p>
        </div>
        </div>
      </div>

      <div class="absolute bottom-1/4 -left-10 bg-white rounded-xl shadow-lg p-4 transform -rotate-3 animate-float"
        style="animation-delay: 1.5s;">
        <div class="flex items-center space-x-3">
        <div class="w-10 h-10 rounded-full bg-accent-100 flex items-center justify-center text-accent-600">
          <i class="ri-calendar-event-line"></i>
        </div>
        <div>
          <p class="text-sm font-semibold text-gray-800">New Event</p>
          <p class="text-xs text-gray-500">Tomorrow</p>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-20 bg-gray-50 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-white to-gray-50 -z-10"></div>

    <!-- Animated Shapes -->
    <div
    class="absolute top-20 right-10 w-72 h-72 bg-primary-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse-slow">
    </div>
    <div
    class="absolute bottom-20 left-10 w-72 h-72 bg-secondary-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse-slow">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-10">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Feature 1 -->
      <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 hover:border-primary-200 card-hover">
      <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center mb-6 text-primary-600">
        <i class="ri-team-line text-3xl"></i>
      </div>
      <h3 class="text-2xl font-bold mb-4 text-gray-900">Smart Memberships</h3>
      <p class="text-gray-600 mb-6">
        Track and manage your club members effortlessly, with smart notifications and status updates.
      </p>
      <ul class="space-y-3">
        <li class="flex items-center text-gray-600">
        <i class="ri-check-line text-primary-600 mr-2"></i>
        Member profiles & directories
        </li>
        <li class="flex items-center text-gray-600">
        <i class="ri-check-line text-primary-600 mr-2"></i>
        Automated reminders
        </li>
        <li class="flex items-center text-gray-600">
        <i class="ri-check-line text-primary-600 mr-2"></i>
        Attendance tracking
        </li>
      </ul>
      </div>

      <!-- Feature 2 -->
      <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 hover:border-secondary-200 card-hover">
      <div class="w-16 h-16 rounded-2xl bg-secondary-100 flex items-center justify-center mb-6 text-secondary-600">
        <i class="ri-calendar-event-line text-3xl"></i>
      </div>
      <h3 class="text-2xl font-bold mb-4 text-gray-900">Event Mastery</h3>
      <p class="text-gray-600 mb-6">
        Organize, schedule, and monitor club events like a pro. No hassle, full control.
      </p>
      <ul class="space-y-3">
        <li class="flex items-center text-gray-600">
        <i class="ri-check-line text-secondary-600 mr-2"></i>
        Event calendar & scheduling
        </li>
        <li class="flex items-center text-gray-600">
        <i class="ri-check-line text-secondary-600 mr-2"></i>
        Guest management
        </li>
        <li class="flex items-center text-gray-600">
        <i class="ri-check-line text-secondary-600 mr-2"></i>
        Venue & resource booking
        </li>
      </ul>
      </div>

      <!-- Feature 3 -->
      <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 hover:border-accent-200 card-hover">
      <div class="w-16 h-16 rounded-2xl bg-accent-100 flex items-center justify-center mb-6 text-accent-600">
        <i class="ri-money-dollar-circle-line text-3xl"></i>
      </div>
      <h3 class="text-2xl font-bold mb-4 text-gray-900">Finance Insights</h3>
      <p class="text-gray-600 mb-6">
        Monitor revenue, track expenses, and visualize your club's financial health in real-time.
      </p>
      <ul class="space-y-3">
        <li class="flex items-center text-gray-600">
        <i class="ri-check-line text-accent-600 mr-2"></i>
        Budget planning
        </li>
        <li class="flex items-center text-gray-600">
        <i class="ri-check-line text-accent-600 mr-2"></i>
        Payment processing
        </li>
        <li class="flex items-center text-gray-600">
        <i class="ri-check-line text-accent-600 mr-2"></i>
        Financial reporting
        </li>
      </ul>
      </div>
    </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="py-20 bg-gradient-to-r from-primary-600 to-secondary-600 text-white clip-path-slant">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <div
      class="bg-white/10 backdrop-blur-md rounded-2xl p-8 text-center transform hover:scale-105 transition-transform duration-300">
      <div class="text-5xl font-extrabold mb-2">50+</div>
      <p class="text-xl opacity-90">Clubs Powered</p>
      </div>

      <div
      class="bg-white/10 backdrop-blur-md rounded-2xl p-8 text-center transform hover:scale-105 transition-transform duration-300">
      <div class="text-5xl font-extrabold mb-2">10K+</div>
      <p class="text-xl opacity-90">Active Members</p>
      </div>

      <div
      class="bg-white/10 backdrop-blur-md rounded-2xl p-8 text-center transform hover:scale-105 transition-transform duration-300">
      <div class="text-5xl font-extrabold mb-2">500+</div>
      <p class="text-xl opacity-90">Events Organized</p>
      </div>

      <div
      class="bg-white/10 backdrop-blur-md rounded-2xl p-8 text-center transform hover:scale-105 transition-transform duration-300">
      <div class="text-5xl font-extrabold mb-2">99%</div>
      <p class="text-xl opacity-90">Satisfaction Rate</p>
      </div>
    </div>
    </div>
  </section>

  <!-- Popular Clubs Section -->
  <section id="clubs" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
    <div class="mb-8">
      <h2 class="text-4xl font-bold mb-2 text-gray-900 font-poppins">
      Popular Clubs
      </h2>
      <p class="text-xl text-gray-600">
      Join these thriving communities and pursue your passions with like-minded students
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach($popularClubs as $club)
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover">
      <div class="h-48 bg-gradient-to-r from-primary-500 to-primary-700 relative">
      <img src="{{ $club->banner ? asset('storage/' . $club->banner) : 'https://placehold.co/400x200' }}"
      alt="{{ $club->name }}" class="w-full h-full object-cover mix-blend-overlay" />
      <div
      class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-primary-600 font-bold px-3 py-1 rounded-full text-sm">
      {{ $club->memberships_count }} Members
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
        @if ($club->memberships_count > 3)
      <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Member"
      class="w-8 h-8 rounded-full border-2 border-white" />
      <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Member"
      class="w-8 h-8 rounded-full border-2 border-white" />
      <img src="https://randomuser.me/api/portraits/women/48.jpg" alt="Member"
      class="w-8 h-8 rounded-full border-2 border-white" />
      <div
      class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs font-medium text-gray-500">
      +{{ $club->memberships_count - 3 }}
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

    <div class="mt-12 text-center">
      <a href="/clubs"
      class="inline-flex items-center justify-center bg-white text-primary-600 border border-primary-200 hover:border-primary-300 font-semibold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition">
      Explore All Clubs
      <i class="ri-arrow-right-line ml-2"></i>
      </a>
    </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonials" class="py-20 bg-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-radial from-primary-50 to-transparent opacity-70 -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-10">
    <div class="text-center max-w-3xl mx-auto mb-16">
      <h2 class="text-4xl font-bold mb-6 text-gray-900 font-poppins">
      What Club Leaders Say
      </h2>
      <p class="text-xl text-gray-600">
      Hear from the students who have transformed their clubs with Joinify
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Testimonial 1 -->
      <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 relative">
      <div class="absolute -top-5 left-1/2 transform -translate-x-1/2">
        <div class="w-10 h-10 bg-primary-600 rounded-full flex items-center justify-center shadow-glow">
        <i class="ri-double-quotes-l text-white"></i>
        </div>
      </div>
      <div class="pt-4">
        <p class="text-gray-600 mb-6 italic">
        "As a club president, Joinify has made it so much easier to manage our members and events. The financial
        tracking is especially helpful."
        </p>
        <div class="flex items-center">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Doe"
          class="h-12 w-12 rounded-full mr-4 border-2 border-primary-100" />
        <div>
          <h4 class="font-bold text-gray-900">John Doe</h4>
          <p class="text-primary-600">Photography Club President</p>
        </div>
        </div>
      </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 relative">
      <div class="absolute -top-5 left-1/2 transform -translate-x-1/2">
        <div class="w-10 h-10 bg-secondary-600 rounded-full flex items-center justify-center shadow-glow-secondary">
        <i class="ri-double-quotes-l text-white"></i>
        </div>
      </div>
      <div class="pt-4">
        <p class="text-gray-600 mb-6 italic">
        "The event planning features have transformed how we organize our club activities. We can now easily track
        attendance and communicate with guests."
        </p>
        <div class="flex items-center">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Jane Smith"
          class="h-12 w-12 rounded-full mr-4 border-2 border-secondary-100" />
        <div>
          <h4 class="font-bold text-gray-900">Jane Smith</h4>
          <p class="text-secondary-600">Debate Club Secretary</p>
        </div>
        </div>
      </div>
      </div>

      <!-- Testimonial 3 -->
      <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 relative">
      <div class="absolute -top-5 left-1/2 transform -translate-x-1/2">
        <div class="w-10 h-10 bg-accent-600 rounded-full flex items-center justify-center shadow-glow-accent">
        <i class="ri-double-quotes-l text-white"></i>
        </div>
      </div>
      <div class="pt-4">
        <p class="text-gray-600 mb-6 italic">
        "As an advisor overseeing multiple clubs, this platform gives me the visibility I need while allowing each
        club to maintain their autonomy."
        </p>
        <div class="flex items-center">
        <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Robert Johnson"
          class="h-12 w-12 rounded-full mr-4 border-2 border-accent-100" />
        <div>
          <h4 class="font-bold text-gray-900">Robert Johnson</h4>
          <p class="text-accent-600">Faculty Advisor</p>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      <div>
      <h2 class="text-4xl font-bold mb-6 text-gray-900 font-poppins">
        Built for Campus Leaders
      </h2>
      <p class="text-xl text-gray-600 mb-8">
        Whether you're a club executives, advisor, or a member, Joinify gives you the power to organize, manage, and
        grow with confidence.
      </p>

      <div class="space-y-6">
        <div class="flex items-start">
        <div class="flex-shrink-0 mt-1">
          <div class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center">
          <i class="ri-check-line text-primary-600"></i>
          </div>
        </div>
        <div class="ml-4">
          <h3 class="text-xl font-semibold text-gray-900">For Club Executives</h3>
          <p class="text-gray-600">
          Oversee all aspects of your club with comprehensive dashboards and tools.
          </p>
        </div>
        </div>

        <div class="flex items-start">
        <div class="flex-shrink-0 mt-1">
          <div class="w-6 h-6 rounded-full bg-secondary-100 flex items-center justify-center">
          <i class="ri-check-line text-secondary-600"></i>
          </div>
        </div>
        <div class="ml-4">
          <h3 class="text-xl font-semibold text-gray-900">For Advisors</h3>
          <p class="text-gray-600">
          Monitor multiple clubs and provide guidance with advisor-specific tools.
          </p>
        </div>
        </div>

        <div class="flex items-start">
        <div class="flex-shrink-0 mt-1">
          <div class="w-6 h-6 rounded-full bg-accent-100 flex items-center justify-center">
          <i class="ri-check-line text-accent-600"></i>
          </div>
        </div>
        <div class="ml-4">
          <h3 class="text-xl font-semibold text-gray-900">For Members</h3>
          <p class="text-gray-600">
          Stay connected with your clubs and never miss important updates or events.
          </p>
        </div>
        </div>
      </div>

      <div class="mt-10">
        <a href="/clubs"
        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-4 rounded-xl shadow-glow hover:shadow-lg transform hover:scale-105 transition-all duration-300">
        Get Started Free
        </a>
      </div>
      </div>

      <div class="relative">
      <div class="absolute -top-10 -left-10 w-40 h-40 bg-primary-200 rounded-full opacity-50 animate-float"></div>
      <div class="absolute -bottom-5 -right-5 w-32 h-32 bg-secondary-200 rounded-full opacity-50 animate-float"
        style="animation-delay: 1s;"></div>

      <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80"
        alt="Team collaboration" class="relative z-10 rounded-2xl shadow-2xl" />
      </div>
    </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-20 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-500 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-4xl font-bold mb-6 font-poppins">
      Ready to Transform Your Club Experience?
    </h2>
    <p class="text-xl mb-10 opacity-90 max-w-3xl mx-auto">
      Join thousands of campus clubs already using Joinify to manage their communities, events, and finances.
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="/clubs"
      class="bg-white text-primary-600 font-semibold px-8 py-4 rounded-xl shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
      Get Started Free
      </a>
    </div>
    </div>
  </section>

@endsection