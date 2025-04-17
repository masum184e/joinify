@extends('includes.layout')

@section('title', 'Environment Club')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-lg mt-10">
<h1 class="text-4xl font-extrabold mb-8 text-blue-800 border-b pb-4">👤 Member Details</h1>

  <!-- Member Info -->
  <div class="mb-6">
  <h2 class="text-2xl font-bold text-gray-800 mb-4">🧾 Personal Information</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <h3 class="font-medium text-gray-700">Full Name</h3>
        <p class="text-lg text-gray-900">Alice Johnson</p>
      </div>
      <div>
        <h3 class="font-medium text-gray-700">Email Address</h3>
        <p class="text-lg text-gray-900">alice.johnson@example.com</p>
      </div>
      <div>
        <h3 class="font-medium text-gray-700">Student ID</h3>
        <p class="text-lg text-gray-900">S12345678</p>
      </div>
      <div>
        <h3 class="font-medium text-gray-700">Departments</h3>
        <p class="text-lg text-gray-900">Computer Science & Technology</p>
      </div>
    </div>
  </div>

  <!-- Contact Info -->
  <div class="mb-6">
  <h2 class="text-2xl font-bold text-gray-800 mb-4">📞 Contact Information</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <h3 class="font-medium text-gray-700">Phone Number</h3>
        <p class="text-lg text-gray-900">(555) 123-4567</p>
      </div>
    </div>
  </div>

  <div class="">
  <h2 class="text-2xl font-bold text-gray-800 mb-6">🌟 Member Of</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Club Card 1 -->
    <div class="bg-white border border-blue-100 rounded-xl shadow-md p-5 hover:shadow-lg transition">
      <div class="flex items-center mb-3">
        <div class="bg-blue-500 text-white p-3 rounded-full mr-4">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a8 8 0 00-8 8h16a8 8 0 00-8-8z"></path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-blue-700">Tech Club</h3>
          <p class="text-sm text-gray-500">President</p>
        </div>
      </div>
    </div>

    <!-- Club Card 2 -->
    <div class="bg-white border border-green-100 rounded-xl shadow-md p-5 hover:shadow-lg transition">
      <div class="flex items-center mb-3">
        <div class="bg-green-500 text-white p-3 rounded-full mr-4">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 7v4a1 1 0 001 1h3m10-6h3a1 1 0 011 1v4m-9-5v6m0 0H9m3 0h3"></path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-green-700">Robotics Club</h3>
          <p class="text-sm text-gray-500">Member</p>
        </div>
      </div>
    </div>

    <!-- Club Card 3 -->
    <div class="bg-white border border-purple-100 rounded-xl shadow-md p-5 hover:shadow-lg transition">
      <div class="flex items-center mb-3">
        <div class="bg-purple-500 text-white p-3 rounded-full mr-4">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 16v-1a4 4 0 014-4h4m-6 0a4 4 0 014-4h4M5 19h14M5 21h14M3 7h18"></path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-purple-700">Coding Club</h3>
          <p class="text-sm text-gray-500">Member</p>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

@endsection
