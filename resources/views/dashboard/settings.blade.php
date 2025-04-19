@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Advisor')

@section('layout-title', 'Student Advisor')
@section('layout-sub-title', 'Manage your club\'s events and members efficiently.')

@section('content')
    <!-- Alpine.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <div x-data="{ tab: 'profile' }" class="">

        <!-- Tabs -->
        <div class="flex space-x-4 border-b mb-6">
            <button @click="tab = 'profile'" :class="tab === 'profile' ? 'border-blue-600 text-blue-600' : 'text-gray-500'"
                class="pb-2 border-b-2 font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5.121 17.804A4 4 0 016 16h12a4 4 0 01.879.804M16 11a4 4 0 10-8 0 4 4 0 008 0z" />
                </svg>
                Profile
            </button>

            <button @click="tab = 'account'" :class="tab === 'account' ? 'border-blue-600 text-blue-600' : 'text-gray-500'"
                class="pb-2 border-b-2 font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 11c0 .34-.03.67-.08.99M12 11V7m0 4c0 1.1-.9 2-2 2H9m3 0h3m0 0c1.1 0 2-.9 2-2m0 0V7m0 4c0 .34.03.67.08.99M21 12.01a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Account
            </button>
        </div>

        <!-- Profile -->
        <div x-show="tab === 'profile'" x-transition>
            <form class="bg-white rounded-2xl shadow-xl p-8 space-y-6 border border-gray-100">
                <div class="flex items-center gap-2 text-gray-800">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.144 0 4.152.502 5.879 1.386M15 10a3 3 0 11-6 0 3 3 0 016 0zM19.428 15.341A8 8 0 1112 4a8 8 0 017.428 11.341z" />
                    </svg>
                    <h2 class="text-xl font-semibold">Profile Information</h2>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="full_name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                            placeholder="John Doe">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                            placeholder="john@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                            placeholder="+123456789">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                        <input type="file" name="avatar"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    </div>
                </div>

                <!-- Save Button -->
                <div class="text-right pt-4">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 407.096 407.096"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M402.115,84.008L323.088,4.981C319.899,1.792,315.574,0,311.063,0H17.005C7.613,0,0,7.614,0,17.005v373.086c0,9.392,7.613,17.005,17.005,17.005h373.086c9.392,0,17.005-7.613,17.005-17.005V96.032C407.096,91.523,405.305,87.197,402.115,84.008z M300.664,163.567H67.129V38.862h233.535V163.567z" />
                            <path
                                d="M214.051,148.16h43.08c3.131,0,5.668-2.538,5.668-5.669V59.584c0-3.13-2.537-5.668-5.668-5.668h-43.08c-3.131,0-5.668,2.538-5.668,5.668v82.907C208.383,145.622,210.92,148.16,214.051,148.16z" />
                        </svg>
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Account -->
        <div x-show="tab === 'account'" x-transition>
            <form class="bg-white rounded-2xl shadow-xl p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-2.673 0-8 1.336-8 4v3h16v-3c0-2.664-5.327-4-8-4z" />
                    </svg>
                    Account Settings
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Change Password</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                            placeholder="••••••••">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                            placeholder="••••••••">
                    </div>
                </div>
                <!-- Save Button -->
                <div class="text-right pt-4">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 407.096 407.096"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M402.115,84.008L323.088,4.981C319.899,1.792,315.574,0,311.063,0H17.005C7.613,0,0,7.614,0,17.005v373.086c0,9.392,7.613,17.005,17.005,17.005h373.086c9.392,0,17.005-7.613,17.005-17.005V96.032C407.096,91.523,405.305,87.197,402.115,84.008z M300.664,163.567H67.129V38.862h233.535V163.567z" />
                            <path
                                d="M214.051,148.16h43.08c3.131,0,5.668-2.538,5.668-5.669V59.584c0-3.13-2.537-5.668-5.668-5.668h-43.08c-3.131,0-5.668,2.538-5.668,5.668v82.907C208.383,145.622,210.92,148.16,214.051,148.16z" />
                        </svg>
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>

        </div>

    </div>

@endsection