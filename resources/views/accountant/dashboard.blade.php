@extends('accountant.includes.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-5">

  <!-- Financial Overview -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white rounded-xl shadow p-4">
      <p class="text-sm text-gray-600">Total Budget</p>
      <p class="text-2xl font-semibold">$1,200</p>
    </div>
    <div class="bg-white rounded-xl shadow p-4">
      <p class="text-sm text-gray-600">Expenses</p>
      <p class="text-2xl font-semibold">$840</p>
    </div>
    <div class="bg-white rounded-xl shadow p-4">
      <p class="text-sm text-gray-600">Remaining</p>
      <p class="text-2xl font-semibold text-green-600">$360</p>
    </div>
  </div>

  <div class="bg-white p-6 rounded-lg shadow">
  <h3 class="font-semibold mb-4">Revenue</h3>
          <div class="bg-gray-100 h-40 flex items-center justify-center text-gray-400">
            [Insert Line Chart]
          </div>
  </div>
<!-- Recent Transactions Table -->
<div class="bg-white rounded-xl shadow p-6">
  <h2 class="text-lg font-semibold mb-4">Recent Transactions</h2>

  <div class="overflow-x-auto">
    <table class="min-w-full text-sm text-left text-gray-600">
      <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
        <tr>
          <th class="px-4 py-3">Date</th>
          <th class="px-4 py-3">Description</th>
          <th class="px-4 py-3">Type</th>
          <th class="px-4 py-3 text-right">Amount</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        <tr>
          <td class="px-4 py-3">Apr 10, 2025</td>
          <td class="px-4 py-3">Event Decoration</td>
          <td class="px-4 py-3">Expense</td>
          <td class="px-4 py-3 text-right text-red-600">- $150.00</td>
        </tr>
        <tr>
          <td class="px-4 py-3">Apr 08, 2025</td>
          <td class="px-4 py-3">Stationery</td>
          <td class="px-4 py-3">Expense</td>
          <td class="px-4 py-3 text-right text-red-600">- $40.00</td>
        </tr>
        <tr>
          <td class="px-4 py-3">Apr 06, 2025</td>
          <td class="px-4 py-3">Sponsorship Income</td>
          <td class="px-4 py-3">Income</td>
          <td class="px-4 py-3 text-right text-green-600">+ $200.00</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

</div>

@endsection
