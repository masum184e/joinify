@extends('includes.layout')

@section('title', 'Join '.$club->name)
@section('sub-title', 'Joinify')

@section('content')

  <!-- Join Form -->
  <section class="pb-12 pt-28 bg-gradient-to-b from-primary-50 to-gray-50">
    <h1 class="text-4xl font-bold text-gray-900 text-center font-poppins mb-8">Join {{ $club->name }}</h1>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-gray-50 rounded-xl shadow-sm border border-gray-200 overflow-hidden">
      <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
      <h3 class="text-lg font-medium text-gray-900">Membership Application</h3>
      <p class="mt-1 text-sm text-gray-500">Please provide your information to join the {{ $club->name }}.</p>
      </div>

      @if(session('error'))
      <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
      <div class="flex">
      <div class="flex-shrink-0">
      <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
        fill="currentColor">
        <path fill-rule="evenodd"
        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
        clip-rule="evenodd" />
      </svg>
      </div>
      <div class="ml-3">
      <p class="text-sm text-red-700">{{ session('error') }}</p>
      </div>
      </div>
      </div>
    @endif

      <form action="{{ url('/pay/' . $club->id) }}" method="POST" class="px-4 py-5 sm:p-6">
      @csrf
      <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
        <!-- Personal Information -->
        <div class="sm:col-span-6">
        <h3 class="text-lg font-medium text-gray-900 mb-3">Personal Information</h3>
        </div>

        <div class="sm:col-span-6">
        <label for="name" class="block text-sm font-medium text-gray-700">Full name <span
          class="text-red-500">*</span></label>
        <div class="mt-1">
          <input type="text" id="name" placeholder="John Doe" name="name" value="{{ old('name') }}" required
          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm @error('name') border-red-500 @enderror">
          @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
        </div>
        </div>

        <div class="sm:col-span-3">
        <label for="email" class="block text-sm font-medium text-gray-700">Email address <span
          class="text-red-500">*</span></label>
        <div class="mt-1">
          <input type="email" name="email" id="email" required autocomplete="email" value="{{ old('email') }}"
          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm @error('email') border-red-500 @enderror"
          placeholder="email@example.com">
          @error('email')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
        </div>
        </div>

        <div class="sm:col-span-3">
        <label for="phone" class="block text-sm font-medium text-gray-700">Phone number</label>
        <div class="mt-1">
          <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" max="15"
          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm @error('phone') border-red-500 @enderror"
          placeholder="(555) 123-4567">
          @error('phone')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
        </div>
        </div>

        <div class="sm:col-span-3">
        <label for="student_id" class="block text-sm font-medium text-gray-700">Student ID <span
          class="text-red-500">*</span></label>
        <div class="mt-1">
          <input type="text" name="student_id" id="student_id" required value="{{ old('student_id') }}"
          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm @error('student_id') border-red-500 @enderror"
          placeholder="S12345678">
          @error('student_id')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
        </div>
        </div>

        <div class="sm:col-span-3">
        <label for="department" class="block text-sm font-medium text-gray-700">Department <span
          class="text-red-500">*</span></label>
        <div class="mt-1">
          <select id="department" name="department" required
          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm @error('department') border-red-500 @enderror">
          <option value="">Select department</option>
          <option value="arts" {{ old('department') == 'arts' ? 'selected' : '' }}>Visual Arts</option>
          <option value="business" {{ old('department') == 'business' ? 'selected' : '' }}>Business</option>
          <option value="computer-science" {{ old('department') == 'computer-science' ? 'selected' : '' }}>Computer
            Science</option>
          <option value="engineering" {{ old('department') == 'engineering' ? 'selected' : '' }}>Engineering
          </option>
          <option value="humanities" {{ old('department') == 'humanities' ? 'selected' : '' }}>Humanities</option>
          <option value="science" {{ old('department') == 'science' ? 'selected' : '' }}>Science</option>
          <option value="social-sciences" {{ old('department') == 'social-sciences' ? 'selected' : '' }}>Social
            Sciences</option>
          <option value="other" {{ old('department') == 'other' ? 'selected' : '' }}>Other</option>
          </select>
          @error('department')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
        </div>
        </div>

        <!-- Additional Information -->
        <div class="sm:col-span-6">
        <h3 class="text-lg font-medium text-gray-900 mb-3">Additional Information</h3>
        </div>

        <div class="sm:col-span-6">
        <label for="reason" class="block text-sm font-medium text-gray-700">Why do you want to join the Photography
          Club? <span class="text-red-500">*</span></label>
        <div class="mt-1">
          <textarea id="reason" name="reason" rows="4" required
          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm @error('reason') border-red-500 @enderror"
          placeholder="Tell us about yourself and why you want to join...">{{ old('reason') }}</textarea>
          @error('reason')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
        </div>
        </div>

      </div>

      <div class="mt-6 flex justify-end">
        <button type="submit"
        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
        Make Payment
        </button>
      </div>
      </form>
    </div>
    </div>
  </section>
@endsection