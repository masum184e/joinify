@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Secretary')

@section('layout-title', 'Club Secretary')
@section('layout-sub-title', 'Manage your club, track events, and oversee member activities.')


@section('content')
  <div
    class="w-full max-w-3xl p-10 bg-gradient-to-br from-white via-blue-50 to-blue-100 rounded-2xl shadow-xl mx-auto mb-8">
    <h2
    class="text-3xl font-extrabold text-center mb-8 text-blue-800 tracking-tight flex items-center justify-center gap-2">
    @if($page === 'create')
    🎉 Create New Club
  @else
  <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round"
    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
  </svg>
  Update Club Details
@endif
    </h2>

    @php
      $formAction = $page === 'create' ? route('clubs.store') : route('clubs.update', $club->id ?? 0);
      $formMethod = $page === 'create' ? 'POST' : 'PUT';
  @endphp

    <form id="clubForm" name="clubForm" action="{{ $formAction }}" method="POST" class="space-y-6">
    @csrf
    @if($page !== 'create')
    @method('PUT')
  @endif
    <!-- Club Name -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1">Club Name</label>
      <input type="text" placeholder="e.g. Photography Club" name="name"
      class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white"
      required />
    </div>

    <!-- Description -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
      <textarea rows="4" placeholder="Describe the club..." name="description"
      class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 bg-white"
      required></textarea>
    </div>

    <!-- President Info -->
    <div>
      <h3 class="text-lg font-semibold text-gray-800 mb-2">President</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="presidentName"
        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500"
        placeholder="e.g., Alex Johnson" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="presidentEmail"
        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500"
        placeholder="e.g., alex@example.com" required>
      </div>
      </div>
    </div>

    <!-- Accountant Info -->
    <div>
      <h3 class="text-lg font-semibold text-gray-800 mb-2">Accountant</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="accountantName"
        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500"
        placeholder="e.g., Maria Lopez" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="accountantEmail"
        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500"
        placeholder="e.g., maria@example.com" required>
      </div>
      </div>
    </div>

    <!-- Program Secretary Info -->
    <div>
      <h3 class="text-lg font-semibold text-gray-800 mb-2">Program Secretary</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="programSecretaryName"
        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500"
        placeholder="e.g., Chris Evans" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="programSecretaryEmail"
        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal-500"
        placeholder="e.g., chris@example.com" required>
      </div>
      </div>
    </div>

    <!-- Submit Button -->
    <div class="pt-6">
      <button type="submit"
      class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold px-6 py-3 rounded-xl shadow-lg transform hover:scale-[1.02] transition duration-300 ease-in-out flex items-center justify-center gap-2">
      @if($page === 'create')
      🚀 Send Invitation
    @else
      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 407.096 407.096">
      <path d="M402.115,84.008L323.088,4.981..." />
      <path d="M214.051,148.16h43.08c3.131,0..." />
      </svg>
      <span>Save Changes</span>
    @endif
      </button>
    </div>
    </form>
  </div>
@endsection

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function () {
    $('#clubForm').on('submit', function (e) {
      e.preventDefault();

      let formData = $(this).serialize();
      const route = @json($page === 'create' ? route('clubs.store') : route('clubs.update', $club->id ?? 0));

      $.ajax({
      url: route,
      method: "POST",
      data: formData,
      success: function (response) {
        if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: $page === 'create' ? 'Club created successfully.' : 'Club updated successfully.',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Go to Dashboard'
        }).then(() => {
          window.location.href = response.redirect || '/dashboard';
        });
        } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: response.message || 'Something went wrong.'
        });
        }
      },
      error: function (xhr) {
        let msg = xhr.responseJSON?.message || 'Something went wrong.';
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: msg
        });
      }
      });
    });
    });
  </script>
@endpush