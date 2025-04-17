@extends('includes.layout')

@section('title', 'Environment Club')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
  <div class="bg-white shadow-lg rounded-lg p-8">
    
    <!-- Event Title -->
    <h1 class="text-3xl font-bold text-blue-600 mb-2">Tech Talk 2025</h1>
    <p class="text-gray-600 text-sm mb-6">Presented by Coding Club</p>

    <!-- Event Meta Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
      <div>
        <h3 class="text-sm font-semibold text-gray-500 uppercase">Date</h3>
        <p class="text-lg text-gray-800">May 15, 2025</p>
      </div>
      <div>
        <h3 class="text-sm font-semibold text-gray-500 uppercase">Time</h3>
        <p class="text-lg text-gray-800">10:00 AM - 12:00 PM</p>
      </div>
      <div>
        <h3 class="text-sm font-semibold text-gray-500 uppercase">Location</h3>
        <p class="text-lg text-gray-800">Auditorium A, Main Campus</p>
      </div>

    </div>

    <div class="mb-4" > 
    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Guests</h3>
  <ul class="space-y-1 text-gray-700">
    <li class="flex items-start">
       <span class="font-bold text-blue-600" >Dr. Jane Smith</span> <span class="text-sm text-gray-500">(Keynote Speaker)</span>
    </li>
    <li class="flex items-start">
      <span  class="font-bold text-blue-600" >Prof. Alan Turing</span>
    </li>
    <li class="flex items-start">
      <span  class="font-bold text-blue-600" >Sarah Lee </span><span class="text-sm text-gray-500">(Alumni)</span>
    </li>
  </ul>
</div>


    <!-- Description -->
    <div class="">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">Description</h2>
      <p class="text-gray-700 leading-relaxed">
        Join us for an exciting Tech Talk where we explore the future of AI, software innovation,
        and the intersection of technology and society. Our guest speakers will share their
        expertise and insights from academia and industry.
      </p>
    </div>

  </div>
</div>

@endsection
