@extends('dashboard.includes.layout')

@section('title',  ($page === 'create')?'Create New Club':'Update Club Details')
@section('sub-title', 'Joinify')

@section('layout-title', ($page === 'create')?'Create New Club':'Update Club Details')
@section('layout-sub-title', ($page === 'create')?'Fill in the details to create a new club':'Fill in the details to update club information')


@section('content')
  <div class="container">
    <div class="mb-2">
    <h1 class="text-3xl font-bold mb-2">
      @if($page === 'create')
      Create New Club
    @else
      Update Club Details
    @endif
    </h1>
    <p class="text-gray-500">
      @if($page === 'create')
      Fill in the details to create a new university club
    @else
      Fill in the details to update club information
    @endif
    </p>
    <a href="/dashboard/clubs"
      class="inline-flex items-center justify-center text-blue-600 rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50  h-10 py-2 mb-4">
      <i class="ri-arrow-left-line mr-2"></i>
      Back to Clubs
    </a>
    </div>

    <form id="clubForm" method="POST" enctype="multipart/form-data"
    action="{{ $page === 'create' ? '/dashboard/clubs' : '/dashboard/clubs/' . $club->id }}" class="space-y-6">
    @csrf
    @if($page === 'edit')
    @method('PUT')
    @endif
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-4">
      <div class="bg-white rounded-lg border border-gray-200 shadow-sm h-min">
      <div class="p-4 border-b border-border">
        <h3 class="font-medium">Club Information</h3>
        <p class="text-sm text-gray-500">Basic details about the club</p>
      </div>
      <div class="p-4 space-y-4">
        <div class="space-y-2">
        <label for="name"
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Club
          Name</label>
        <input id="name" placeholder="Enter club name" type="text"
          value="{{ old('name', $club->name ?? $page === 'edit' ? $club->name : '') }}" name="name"
          class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
        @error('name')
      <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
        </div>

        <div class="space-y-2">
        <label for="description"
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Description</label>
        <textarea id="description" placeholder="Describe the club's purpose and activities" rows="5"
          name="description"
          class="flex min-h-[80px] w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{{ old('description', $club->description ?? $page === 'edit' ? $club->description : '') }}
      </textarea>
        @error('description')
      <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
        </div>

        <div class="space-y-2">
        <label for="fee"
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Membership
          Fee (৳)</label>
        <input id="fee" placeholder="25" type="text"
          value="{{ old('fee', $club->fee ?? $page === 'edit' ? $club->fee : '') }}" name="fee"
          class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
        @error('fee')
      <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
        </div>

        <div class="space-y-2">
        <label for="banner"
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Banner
          Image</label>
        <div class="border-2 border-dashed rounded-lg p-6 flex flex-col items-center justify-center text-center">
          <i class="ri-upload-line text-gray-500 text-2xl mb-2"></i>
          <p class="text-sm font-medium">Drag and drop an image here or click to browse</p>
          <p class="text-xs text-gray-500 mt-1">Recommended size: 1200 x 300 pixels</p>
          <input id="banner" type="file" class="hidden" name="banner" accept="image/*">
          <button id="selectImageButton"
          class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-300 bg-white hover:bg-gray-100 hover:text-gray-900 h-9 px-3 mt-4">
          Select Image
          </button>
        </div>
        @if(old('banner'))
      <p>Previously selected (validation failed): {{ old('banner') }}</p>
      @elseif(isset($club) && $page === 'edit' && $club->banner)
      <p>Current banner: <a href="{{ asset('storage/' . $club->banner) }}" target="_blank" class="underline">View Banner</a></p>
      <img src="{{ asset('storage/' . $club->banner) }}" alt="{{ $club->name }}" style="max-height: 100px;width:100%;border-radius: 0.2rem;">
      @endif
        @error('banner')
      <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
        </div>
      </div>
      </div>

      <div class="bg-white rounded-lg border border-gray-200 shadow-sm h-min">
      <div class="p-4 border-b border-gray-200">
        <h3 class="font-medium">Club Executives</h3>
        <p class="text-sm text-gray-500">Add required executive members</p>
      </div>
      <div class="p-4 space-y-6">
        <div class="space-y-4">
        <h3 class="font-medium">President</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="space-y-2">
          <label for="president_name"
            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Name</label>
          <input id="president_name" placeholder="Full name" type="text"
            value="{{ old('president_name', $club->president?->user?->name ?? $page === 'edit' ? $club->president?->user?->name : '') }}"
            name="president_name"
            class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          @error('president_name')
        <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
          </div>
          <div class="space-y-2">
          <label for="president_email"
            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Email</label>
          <input id="president_email" type="email" placeholder="Edu email"
            value="{{ old('president_email', $club->president?->user?->email ?? $page === 'edit' ? $club->president?->user?->email : '') }}"
            name="president_email"
            class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          @error('president_email')
        <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
          </div>
        </div>
        </div>

        <div class="space-y-4">
        <h3 class="font-medium">Secretary</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="space-y-2">
          <label for="secretary_name"
            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Name</label>
          <input id="secretary_name" placeholder="Full name" type="text"
            value="{{ old('secretary_name', $club->secretary?->user?->name ?? $page === 'edit' ? $club->secretary?->user?->name : '') }}"
            name="secretary_name"
            class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          @error('secretary_name')
        <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
          </div>
          <div class="space-y-2">
          <label for="secretary_email"
            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Email</label>
          <input id="secretary_email" type="email" placeholder="Edu email"
            value="{{ old('secretary_email', $club->secretary?->user?->email ?? $page === 'edit' ? $club->secretary?->user?->email : '') }}"
            name="secretary_email"
            class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          @error('secretary_email')
        <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
          </div>
        </div>
        </div>

        <div class="space-y-4">
        <h3 class="font-medium">Accountant</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="space-y-2">
          <label for="accountant_name"
            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Name</label>
          <input id="accountant_name" placeholder="Full name" type="text"
            value="{{ old('accountant_name', $club->accountant?->user?->name ?? $page === 'edit' ? $club->accountant?->user?->name : '') }}"
            name="accountant_name"
            class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          @error('accountant_name')
        <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
          </div>
          <div class="space-y-2">
          <label for="accountant_email"
            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Email</label>
          <input id="accountant_email" type="email" placeholder="Edu email"
            value="{{ old('accountant_email', $club->accountant?->user?->email ?? $page === 'edit' ? $club->accountant?->user?->email : '') }}"
            name="accountant_email"
            class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          @error('accountant_email')
        <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
          </div>
        </div>
        </div>
      </div>
      <div class=" flex justify-end gap-2 p-4">
        <button type="reset"
        class=" rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-300 bg-white hover:bg-gray-100 hover:text-gray-900 px-4 py-2 text-center">
        Cancel
        </button>
        <button type="submit"
        class="flex gap-2 rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-blue-600 text-white hover:bg-blue-600/90 px-4 py-2">
        @if($page === 'create')
      🚀 Send Invitation
      @else

      <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
        stroke="#fff">
        <g id="SVGRepo_bgCarrier" stroke-width="0" />
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
        <g id="SVGRepo_iconCarrier">
        <path
        d="M17 20.75H7C6.27065 20.75 5.57118 20.4603 5.05546 19.9445C4.53973 19.4288 4.25 18.7293 4.25 18V6C4.25 5.27065 4.53973 4.57118 5.05546 4.05546C5.57118 3.53973 6.27065 3.25 7 3.25H14.5C14.6988 3.25018 14.8895 3.32931 15.03 3.47L19.53 8C19.6707 8.14052 19.7498 8.33115 19.75 8.53V18C19.75 18.7293 19.4603 19.4288 18.9445 19.9445C18.4288 20.4603 17.7293 20.75 17 20.75ZM7 4.75C6.66848 4.75 6.35054 4.8817 6.11612 5.11612C5.8817 5.35054 5.75 5.66848 5.75 6V18C5.75 18.3315 5.8817 18.6495 6.11612 18.8839C6.35054 19.1183 6.66848 19.25 7 19.25H17C17.3315 19.25 17.6495 19.1183 17.8839 18.8839C18.1183 18.6495 18.25 18.3315 18.25 18V8.81L14.19 4.75H7Z"
        fill="#fff" />
        <path
        d="M16.75 20H15.25V13.75H8.75V20H7.25V13.5C7.25 13.1685 7.3817 12.8505 7.61612 12.6161C7.85054 12.3817 8.16848 12.25 8.5 12.25H15.5C15.8315 12.25 16.1495 12.3817 16.3839 12.6161C16.6183 12.8505 16.75 13.1685 16.75 13.5V20Z"
        fill="#fff" />
        <path
        d="M12.47 8.75H8.53001C8.3606 8.74869 8.19311 8.71403 8.0371 8.64799C7.88109 8.58195 7.73962 8.48582 7.62076 8.36511C7.5019 8.24439 7.40798 8.10144 7.34437 7.94443C7.28075 7.78741 7.24869 7.61941 7.25001 7.45V4H8.75001V7.25H12.25V4H13.75V7.45C13.7513 7.61941 13.7193 7.78741 13.6557 7.94443C13.592 8.10144 13.4981 8.24439 13.3793 8.36511C13.2604 8.48582 13.1189 8.58195 12.9629 8.64799C12.8069 8.71403 12.6394 8.74869 12.47 8.75Z"
        fill="#fff" />
        </g>
      </svg>
      <span>Save Chagnes</span>
      @endif
        </button>
      </div>
      @if(session('error'))
      <div class="text-red-500 text-sm">
      {{ session('error') }}
      </div>
    @endif

      @if(session('success'))
      <div class="text-green-500 text-sm">
      {{ session('success') }}
      </div>
    @endif
      </div>

    </div>

    </form>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const selectImageButton = document.getElementById('selectImageButton');
    const bannerInput = document.getElementById('banner');

    selectImageButton.addEventListener('click', function (event) {
      event.preventDefault();
      bannerInput.click();
    });

    bannerInput.addEventListener('change', function () {
      if (bannerInput.files.length > 0) {
      const fileName = bannerInput.files[0].name;
      selectImageButton.textContent = fileName;
      } else {
      selectImageButton.textContent = 'Select Image';
      }
    });
    });
  </script>
@endpush