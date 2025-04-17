@extends('advisor.includes.layout')

@section('title', 'Manage Clubs')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-x-auto">
  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-teal-600 text-white">
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Name</th>
        <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">President</th>
        <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Members</th>
        <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Status</th>
        <th scope="col" class="px-6 py-3 text-right text-sm font-medium uppercase tracking-wider">Actions</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 text-sm">
      <!-- Example Member Row -->
      <tr>
        <td class="px-6 py-4 whitespace-nowrap"><a href="/dashboard/clubs/0">Environment Club</a></td>
        <td class="px-6 py-4 whitespace-nowrap">Alex Johnson</td>
        <td class="px-6 py-4 whitespace-nowrap">40, 532</td>
        <td class="px-6 py-4 whitespace-nowrap">
          <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
            President
          </span>
          <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
            Secretary
          </span>
          <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
            Accountant
          </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
          <a class="text-indigo-600 hover:text-indigo-900 font-medium" href="/dashboard/edit-club/1">Edit</a>
          <button class="text-red-600 hover:text-red-900 font-medium">Remove</button>
        </td>
      </tr>

      <!-- Add more rows as needed -->

    </tbody>
  </table>
</div>
<a href="/dashboard/create-club"
   class="fixed bottom-8 right-8 bg-teal-600 hover:bg-teal-700 text-white w-14 h-14 rounded-full flex items-center justify-center text-3xl shadow-lg transition duration-300">
  +
</a>
@endsection