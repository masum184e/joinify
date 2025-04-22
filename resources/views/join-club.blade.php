@extends('includes.layout')

@section('title', 'Environment Club')

@section('content')
  <div class="max-w-4xl mx-auto px-4 py-5">
    <h1 class="text-3xl font-extrabold text-blue-700 mb-6">✨ Become a member of {{ $club->name }}</h1>

    <!-- Join Club Form -->
    <div class="bg-gradient-to-br from-white via-blue-50 to-blue-100 rounded-2xl shadow-xl p-8">
    <h2 class="text-2xl font-bold text-blue-800 mb-6 text-center">
      📝 Membership Form
    </h2>

    <form class="space-y-6" id="joinForm" action="{{ url('/pay') }}" method="POST">

      <input type="hidden" value="{{ csrf_token() }}" name="_token" />

      <!-- Full Name -->
      <div>
      <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
      <input type="text" id="name" placeholder="John Doe" name="name"
        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
      </div>

      <!-- Email Address -->
      <div>
      <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
      <input type="email" id="email" placeholder="john.doe@example.com" name="email"
        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
      </div>

      <!-- Student ID -->
      <div>
      <label for="student-id" class="block text-sm font-semibold text-gray-700 mb-1">Student ID</label>
      <input type="text" id="student-id" placeholder="S1234567" name="student_id"
        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
      </div>

      <!-- Department -->
      <div>
      <label for="department" class="block text-sm font-semibold text-gray-700 mb-1">Department</label>
      <select id="department" name="department"
        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm bg-white text-gray-700">
        <option value="">Select your Department...</option>
        <option value="computer_science">Computer Science</option>
        <option value="business_admin">Business Administration</option>
        <option value="engineering">Engineering</option>
        <option value="arts">Arts</option>
        <option value="biology">Biology</option>
      </select>
      </div>

      <!-- Reason for Joining -->
      <div>
      <label for="reason" class="block text-sm font-semibold text-gray-700 mb-1">Why do you want to join?</label>
      <textarea id="reason" rows="4" placeholder="Tell us why you're interested in this club..." name="reason"
        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"></textarea>
      </div>

      <!-- Submit Button -->
      <div class="pt-4">
      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold px-6 py-3 rounded-xl shadow-lg transition duration-300 ease-in-out">
        Make Payment
      </button>
      <div id="join-error" class="text-red-500 mt-4"></div>

      </div>
    </form>
    </div>
  </div>

@endsection