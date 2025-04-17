@extends('accountant.includes.layout')

@section('title', 'Manage Members')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-end pb-4">

<!-- Search Box -->
<div class="relative">
      <input
        type="text"
        id="memberSearch"
        placeholder="Search member..."
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

  <!-- Member Table -->
  <div class="bg-white shadow-md rounded-lg overflow-x-auto">
  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-teal-600 text-white">
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Name</th>
        <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Email</th>
        <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Payment Date</th>
        <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider text-center">Amount</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 text-sm">
      <!-- Example Member Row -->
      <tr>
            <td class="px-6 py-4">Sarah Johnson</td>
            <td class="px-6 py-4">sarah@example.com</td>
            <td class="px-6 py-4">Jan 15, 2024</td>
            <td class="px-6 py-4 text-center">
              <span class="inline-block bg-blue-100 text-blue-700 px-2 py-1 text-xs font-medium rounded">$50</span>
            </td>
          </tr>

      <!-- Add more rows as needed -->

    </tbody>
  </table>
</div>
@endsection
