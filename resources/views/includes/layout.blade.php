<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="/logo.png" />
  <title>@yield('title') | @yield('sub-title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">
  <!-- Header -->
  <header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <a href="/" class="flex items-center space-x-2 text-blue-600 hover:text-blue-700">
        <img src="/logo.png" alt="Joinify Logo" class="h-8 w-8 object-contain">
        <span class="text-2xl font-bold">Joinify</span>
      </a>
      <nav class="hidden md:flex space-x-6 text-gray-700 font-medium">
        <a href="/" class="{{ request()->is('/') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">Home</a>
        <a href="/clubs"
          class="{{ request()->is('clubs*') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">Clubs</a>
        <a href="/about"
          class="{{ request()->is('about') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">About</a>
        <a href="/contact"
          class="{{ request()->is('contact') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">Contact</a>
      </nav>
    </div>
  </header>

  <main class="container overflow-y-auto h-full scroll-hide">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-white border-t mt-10">
    <div class="max-w-7xl mx-auto px-4 py-5 grid grid-cols-1 md:grid-cols-4 gap-8 text-gray-700 text-sm">
      <!-- Logo & Description -->
      <div>
        <a href="/" class="flex items-center space-x-2 text-blue-600 hover:text-blue-700">
          <img src="/logo.png" alt="Joinify Logo" class="h-8 w-8 object-contain">
          <span class="text-2xl font-bold">Joinify</span>
        </a>
        <p class="text-justify">Connecting students to communities, opportunities, and experiences through clubs and
          organizations.</p>
      </div>

      <!-- Quick Links -->
      <div>
        <h3 class="font-semibold mb-2">Quick Links</h3>
        <ul class="space-y-1">
          <li><a href="#" class="hover:text-blue-600">Home</a></li>
          <li><a href="#" class="hover:text-blue-600">Clubs</a></li>
          <li><a href="#" class="hover:text-blue-600">Events</a></li>
          <li><a href="#" class="hover:text-blue-600">FAQs</a></li>
        </ul>
      </div>

      <!-- Resources -->
      <div>
        <h3 class="font-semibold mb-2">Resources</h3>
        <ul class="space-y-1">
          <li><a class="hover:text-blue-600" href="#">Student Portal</a></li>
          <li><a class="hover:text-blue-600" href="/dashboard">Advisor Login</a></li>
          <li><a class="hover:text-blue-600" href="#">Club Guidelines</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div>
        <h3 class="font-semibold mb-2">Contact Us</h3>
        <p>Email: support@joinify.edu</p>
        <p>Phone: (123) 456-7890</p>
        <div class="flex space-x-3 mt-2">
          <a href="#" class="text-blue-600 hover:underline">Facebook</a>
          <a href="#" class="text-blue-600 hover:underline">Twitter</a>
        </div>
      </div>
    </div>

    <div class="border-t text-center py-4 text-gray-500 text-sm">
      © 2025 Joinify. All rights reserved.
    </div>
  </footer>

</body>

</html>