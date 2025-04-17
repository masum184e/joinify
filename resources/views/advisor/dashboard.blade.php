@extends('advisor.includes.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
          <!-- Cards -->
          <div class="grid grid-cols-5 gap-4">
        <div class="bg-white p-4 rounded-lg shadow text-center">
          <p class="text-sm text-gray-500">Clubs</p>
          <p class="text-xl font-semibold text-green-500">45,320</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
          <p class="text-sm text-gray-500">Members</p>
          <p class="text-xl font-semibold text-green-500">45,320</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
          <p class="text-sm text-gray-500">Revenue</p>
          <p class="text-xl font-semibold text-red-500">- $5,610</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
          <p class="text-sm text-gray-500">Earnings</p>
          <p class="text-xl font-semibold text-pink-500">$7,524</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
          <p class="text-sm text-gray-500">Growth</p>
          <p class="text-xl font-semibold text-green-500">+ 35.52%</p>
        </div>
      </div>

            <!-- Chart & Pie -->
            <div class="grid grid-cols-3 gap-4">
        <div class="col-span-2 bg-white p-6 rounded-lg shadow">
          <h3 class="font-semibold mb-4">Total Member</h3>
          <div class="bg-gray-100 h-40 flex items-center justify-center text-gray-400">
            [Insert Bar Chart]
          </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
          <h3 class="font-semibold mb-4">Revenue</h3>
          <div class="bg-gray-100 h-40 flex items-center justify-center text-gray-400">
            [Insert Pie Chart]
          </div>
        </div>
      </div>

        <!-- Table -->
        <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-semibold mb-4">Most Popular Clubs</h3>
        <table class="w-full text-left text-sm">
          <thead>
            <tr class="text-gray-600 border-b">
              <th class="py-2">Name</th>
              <th class="py-2">Fee</th>
              <th class="py-2">Number of Member</th>
              <th class="py-2">Revenue</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2">Environment Club</td>
              <td class="py-2">$120</td>
              <td class="py-2">530</td>
              <td class="py-2">$63,600</td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2">Science Club</td>
              <td class="py-2">$90</td>
              <td class="py-2">420</td>
              <td class="py-2">$37,800</td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>
</div>
@endsection
