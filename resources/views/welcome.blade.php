@extends('includes.layout')

@section('title', 'Joinify')

@section('content')
<section class="py-20 bg-gradient-to-r from-blue-50 to-white text-center">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Discover and Join Amazing Student Clubs</h1>
    <p class="text-lg text-gray-600 max-w-xl mx-auto mb-6">
      Connect with like-minded students, grow your skills, and make an impact on campus.
    </p>
    <a href="/clubs" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
      Explore Clubs
    </a>
  </section>
@endsection
