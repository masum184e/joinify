@extends('includes.layout')

@section('title', 'Environment Club')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
  <h1 class="text-3xl font-bold text-blue-600 text-center mb-6">Join a Club</h1>
  <p class="text-justify text-gray-600 mb-8">Become a part of our vibrant community by joining one of our student clubs. Select a club below and fill out the form to apply.</p>


  <!-- Join Club Form -->
  <div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Join the Club</h2>

    <form class="space-y-6">

      <!-- Full Name -->
      <div>
        <label for="full-name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
        <input type="text" id="full-name" placeholder="Enter your full name" 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Email Address -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
        <input type="email" id="email" placeholder="Enter your email" 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Student ID -->
      <div>
        <label for="student-id" class="block text-sm font-medium text-gray-700 mb-1">Student ID</label>
        <input type="text" id="student-id" placeholder="Enter your student ID"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

           <!-- Department -->
           <div>
        <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
        <select id="department" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
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
        <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Why do you want to join?</label>
        <textarea id="reason" rows="4" placeholder="Tell us why you're interested in this club..." 
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <!-- Submit Button -->
      <div class="pt-4">
        <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
          Payment
        </button>
      </div>

    </form>
  </div>
</div>

@endsection