@extends('includes.layout')

@section('title', 'Events')
@section('sub-title', 'Joinify')

@section('content')

    <!-- Upcoming Events -->
    <section class="pt-28 pb-8">
        <h1 class="text-4xl font-bold text-gray-900 text-center font-poppins mb-8">Photography Club</h1>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 font-poppins mb-8">Upcoming Events</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Event Card 1 -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1552083375-1447ce886485?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                            alt="Spring Photo Walk" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                            <span class="block text-sm font-semibold text-gray-900">MAY</span>
                            <span class="block text-xl font-bold text-primary-600">15</span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Open Registration
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Spring Photo Walk</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-time-line mr-1.5"></i>
                            <span>10:00 AM - 12:00 PM</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-map-pin-line mr-1.5"></i>
                            <span>University Botanical Gardens</span>
                        </div>
                        <p class="text-gray-600 mb-6">Join us for a relaxing walk through the beautiful botanical gardens as
                            we capture the colors of spring. Perfect for all skill levels.</p>
                        <div class="flex items-center justify-end">
                            <a href="public-event-details.html"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                View Details
                                <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1542038784456-1ea8e935640e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                            alt="Portrait Photography Workshop" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                            <span class="block text-sm font-semibold text-gray-900">MAY</span>
                            <span class="block text-xl font-bold text-primary-600">22</span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Open Registration
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Portrait Photography Workshop</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-time-line mr-1.5"></i>
                            <span>3:00 PM - 5:00 PM</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-map-pin-line mr-1.5"></i>
                            <span>Arts Building, Room 302</span>
                        </div>
                        <p class="text-gray-600 mb-6">Learn essential techniques for capturing stunning portraits with
                            proper lighting, posing, and composition from professional photographer Alex Chen.</p>
                        <div class="flex items-center justify-end">
                            <a href="public-event-details.html"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                View Details
                                <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1527011046414-4781f1f94f8c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                            alt="End of Year Photo Exhibition" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                            <span class="block text-sm font-semibold text-gray-900">JUN</span>
                            <span class="block text-xl font-bold text-primary-600">05</span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Members Only
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">End of Year Photo Exhibition</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-time-line mr-1.5"></i>
                            <span>6:00 PM - 9:00 PM</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-map-pin-line mr-1.5"></i>
                            <span>Student Union Gallery</span>
                        </div>
                        <p class="text-gray-600 mb-6">Celebrate the end of the academic year with our annual exhibition
                            showcasing the best work from our club members. Refreshments provided.</p>
                        <div class="flex items-center justify-end">
                            <a href="public-event-details.html"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                View Details
                                <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Event Card 4 -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1452587925148-ce544e77e70d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                            alt="Lightroom Editing Masterclass" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                            <span class="block text-sm font-semibold text-gray-900">JUN</span>
                            <span class="block text-xl font-bold text-primary-600">12</span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Open Registration
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Lightroom Editing Masterclass</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-time-line mr-1.5"></i>
                            <span>2:00 PM - 4:30 PM</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-map-pin-line mr-1.5"></i>
                            <span>Computer Lab, Tech Building</span>
                        </div>
                        <p class="text-gray-600 mb-6">Take your photos to the next level with this hands-on Adobe Lightroom
                            workshop. Learn professional editing techniques and workflows.</p>
                        <div class="flex items-center justify-end">
                            <a href="public-event-details.html"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                View Details
                                <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Event Card 5 -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1493863641943-9b68992a8d07?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                            alt="Night Photography Basics" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                            <span class="block text-sm font-semibold text-gray-900">JUN</span>
                            <span class="block text-xl font-bold text-primary-600">20</span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Open Registration
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Night Photography Basics</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-time-line mr-1.5"></i>
                            <span>8:00 PM - 10:30 PM</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-map-pin-line mr-1.5"></i>
                            <span>Campus Main Square</span>
                        </div>
                        <p class="text-gray-600 mb-6">Discover the art of night photography in this practical session. Learn
                            about long exposures, light painting, and capturing the night sky.</p>
                        <div class="flex items-center justify-end">
                            <a href="public-event-details.html"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                View Details
                                <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Event Card 6 -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                            alt="Photography Equipment Showcase" class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                            <span class="block text-sm font-semibold text-gray-900">JUL</span>
                            <span class="block text-xl font-bold text-primary-600">08</span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Open Registration
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Photography Equipment Showcase</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-time-line mr-1.5"></i>
                            <span>1:00 PM - 4:00 PM</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-map-pin-line mr-1.5"></i>
                            <span>Arts Building, Room 302</span>
                        </div>
                        <p class="text-gray-600 mb-6">Explore the latest photography gear with representatives from major
                            brands. Try out cameras, lenses, and accessories before you buy.</p>
                        <div class="flex items-center justify-end">
                            <a href="public-event-details.html"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                View Details
                                <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Past Events -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 font-poppins mb-8">Past Events</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Past Event Card 1 -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                            alt="Night Photography Basics" class="w-full h-48 object-cover filter grayscale opacity-80">
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                            <span class="block text-sm font-semibold text-gray-900">APR</span>
                            <span class="block text-xl font-bold text-gray-600">28</span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Completed
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Night Photography Basics</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-time-line mr-1.5"></i>
                            <span>7:00 PM - 9:30 PM</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-map-pin-line mr-1.5"></i>
                            <span>Campus Main Square</span>
                        </div>
                        <p class="text-gray-600 mb-6">Discover the art of night photography in this practical session. Learn
                            about long exposures, light painting, and capturing the night sky.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500endtended</span>
                                        <a href=" public-event-details.html"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                View Details
                                <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                        </div>
                    </div>
                </div>

                <!-- Past Event Card 2 -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1542038784456-1ea8e935640e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                            alt="Photography Equipment Showcase"
                            class="w-full h-48 object-cover filter grayscale opacity-80">
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                            <span class="block text-sm font-semibold text-gray-900">APR</span>
                            <span class="block text-xl font-bold text-gray-600">15</span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Completed
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Photography Equipment Showcase</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-time-line mr-1.5"></i>
                            <span>2:00 PM - 4:00 PM</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-map-pin-line mr-1.5"></i>
                            <span>Arts Building, Room 302</span>
                        </div>
                        <p class="text-gray-600 mb-6">Explore the latest photography gear with representatives from major
                            brands. Try out cameras, lenses, and accessories before you buy.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500endtended</span>
                                        <a href=" public-event-details.html"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                View Details
                                <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                        </div>
                    </div>
                </div>

                <!-- Past Event Card 3 -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1554048612-b6a482bc67e5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                            alt="Macro Photography Workshop" class="w-full h-48 object-cover filter grayscale opacity-80">
                        <div class="absolute top-4 left-4 bg-white rounded-lg shadow-md px-3 py-2 text-center">
                            <span class="block text-sm font-semibold text-gray-900">MAR</span>
                            <span class="block text-xl font-bold text-gray-600">30</span>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Completed
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Macro Photography Workshop</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="ri-time-line mr-1.5"></i>
                            <span>1:00 PM - 3:30 PM</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="ri-map-pin-line mr-1.5"></i>
                            <span>Science Building, Room 105</span>
                        </div>
                        <p class="text-gray-600 mb-6">Discover the fascinating world of macro photography. Learn techniques
                            for capturing stunning close-up images of small subjects.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500endtended</span>
                                        <a href=" public-event-details.html"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                View Details
                                <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-600 to-primary-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold font-poppins mb-4">Join Our Photography Club</h2>
            <p class="text-lg text-primary-100 max-w-3xl mx-auto mb-8">Connect with fellow photography enthusiasts, learn
                new skills, and showcase your work. Membership includes access to equipment, workshops, and exclusive
                events.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/clubs/1/join"
                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-primary-700 bg-white hover:bg-primary-50 shadow-lg hover:shadow-xl transition-all duration-300">
                    Become a Member
                </a>
            </div>
        </div>
    </section>

@endsection