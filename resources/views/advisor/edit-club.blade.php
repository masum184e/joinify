@extends('advisor.includes.layout')

@section('title', 'Update Club Information')

@section('content')
<div class="w-full max-w-3xl p-8 pt-0 mb-8 rounded-lg shadow-lg mx-auto">
<h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Update Club Details</h2>
    <form class="space-y-6">

      <!-- Club Name -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Club Name</label>
        <input type="text" name="clubName" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="e.g., Photography Club" required>
      </div>

      <!-- Description -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Brief description of the club" required></textarea>
      </div>

      <!-- President Info -->
      <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">President</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="presidentName" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="e.g., Alex Johnson" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="presidentEmail" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="e.g., alex@example.com" required>
          </div>
        </div>
      </div>

      <!-- Accountant Info -->
      <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Accountant</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="accountantName" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="e.g., Maria Lopez" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="accountantEmail" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="e.g., maria@example.com" required>
          </div>
        </div>
      </div>

      <!-- Program Secretary Info -->
      <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Program Secretary</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="programSecretaryName" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="e.g., Chris Evans" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="programSecretaryEmail" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="e.g., chris@example.com" required>
          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit" class="w-full bg-teal-600 text-white font-semibold py-3 rounded-lg hover:bg-teal-700 transition">
          Update Invitation
        </button>
      </div>
    </form>
  </div>
@endsection