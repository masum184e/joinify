@extends('advisor.includes.layout')

@section('title', 'Club Details')

@section('content')

<!-- Admin/Advisor Club Details Page -->
<div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-lg">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
    <a class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700" href="/dashboard/edit-club/0" >
      Edit Club
    </a>
  </div>

  <p class="text-gray-700 mb-4">
    A club for students interested in building, programming, and competing with robots.
  </p>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div>
      <h2 class="font-semibold text-lg text-gray-700">Created At</h2>
      <p>January 15, 2023</p>
    </div>
    <div>
      <h2 class="font-semibold text-lg text-gray-700">Total Member</h2>
      <p>52,344</p>
    </div>
    <div>
      <h2 class="font-semibold text-lg text-gray-700">Reveneu</h2>
      <p>$123, 126</p>
    </div>
    <div>
      <h2 class="font-semibold text-lg text-gray-700">Status</h2>
      <span class="px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">
        Active
      </span>
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

  <!-- Regular Members List -->
  <div class="mt-12">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-semibold text-gray-800">All Club Members</h2>

    <!-- Search Box -->
    <div class="relative">
      <input
        type="text"
        id="memberSearch"
        placeholder="Search members..."
        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-teal-500 focus:outline-none"
      />
      <svg
        class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 pointer-events-none"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"></path>
      </svg>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-xl overflow-hidden shadow">
      <thead class="bg-gray-100 text-gray-700 text-left text-sm uppercase">
        <tr>
          <th class="px-6 py-3">#</th>
          <th class="px-6 py-3">Name</th>
          <th class="px-6 py-3">Email</th>
          <th class="px-6 py-3">Joined Date</th>
        </tr>
      </thead>
      <tbody id="membersTable" class="text-gray-700">
        <!-- Example row -->
        <tr class="border-t hover:bg-gray-50">
          <td class="px-6 py-4">1</td>
          <td class="px-6 py-4 font-medium">Alice Johnson</td>
          <td class="px-6 py-4">alice@example.com</td>
          <td class="px-6 py-4">Jan 12, 2023</td>
        </tr>
        <tr class="border-t hover:bg-gray-50">
          <td class="px-6 py-4">2</td>
          <td class="px-6 py-4 font-medium">Bob Lee</td>
          <td class="px-6 py-4">bob@example.com</td>
          <td class="px-6 py-4">Feb 20, 2023</td>
        </tr>
        <tr class="border-t hover:bg-gray-50">
          <td class="px-6 py-4">3</td>
          <td class="px-6 py-4 font-medium">Carlos Nguyen</td>
          <td class="px-6 py-4">carlos@example.com</td>
          <td class="px-6 py-4">Feb 21, 2023</td>
        </tr>
        <tr class="border-t hover:bg-gray-50">
          <td class="px-6 py-4">4</td>
          <td class="px-6 py-4 font-medium">Emma Watson</td>
          <td class="px-6 py-4">emma@example.com</td>
          <td class="px-6 py-4">Mar 05, 2023</td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>
</div>
</div>
@endsection