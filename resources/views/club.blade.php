@extends('includes.layout')

@section('title', 'Environment Club')

@section('content')
<!-- Public/Student Club Details Page -->
<div class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow-lg mt-10">
  <h1 class="text-3xl font-bold mb-4 text-gray-800">@yield('title')</h1>

  <p class="text-gray-700 mb-4">
    A club for students interested in building, programming, and competing with robots.
  </p>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
  <div>
      <h2 class="font-semibold text-lg text-gray-700">Created At</h2>
      <p>January 15, 2023</p>
    </div>
    <div>
      <h2 class="font-semibold text-lg text-gray-700">Total Member</h2>
      <p>52,344</p>
    </div>
    <div>
      <h2 class="font-semibold text-lg text-gray-700">Monthly Fee</h2>
      <p class="text-gray-900 text-xl font-semibold">$20</p>
    </div>
  </div>
  <div class="mb-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Executive Members</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <!-- Example Card -->
      <div class="bg-blue-50 p-5 rounded-xl shadow hover:shadow-md transition">
        <h3 class="text-lg font-semibold text-blue-800 mb-1">President</h3>
        <p class="text-gray-900 font-medium">Alice Johnson</p>
        <p class="text-sm text-gray-600">alice@example.com</p>
      </div>

      <div class="bg-blue-50 p-5 rounded-xl shadow hover:shadow-md transition">
        <h3 class="text-lg font-semibold text-blue-800 mb-1">Secretary</h3>
        <p class="text-gray-900 font-medium">Bob Lee</p>
        <p class="text-sm text-gray-600">bob@example.com</p>
      </div>

      <div class="bg-blue-50 p-5 rounded-xl shadow hover:shadow-md transition">
        <h3 class="text-lg font-semibold text-blue-800 mb-1">Accountant</h3>
        <p class="text-gray-900 font-medium">Carlos Nguyen</p>
        <p class="text-sm text-gray-600">carlos@example.com</p>
      </div>
    </div>
  </div>
  <div class="mt-6">
    <a class="bg-teal-500 text-white px-4 py-2 rounded hover:bg-teal-500 block w-full text-center font-bold" href="/join-club">
      Join Club
    </a>
  </div>
</div>
@endsection
