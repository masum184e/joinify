<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('Joinify')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Header -->
  <header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <div class="text-2xl font-bold text-blue-600">Joinify</div>
      <nav class="hidden md:flex space-x-6 text-gray-700 font-medium">
        <a href="#" class="hover:text-blue-600">Home</a>
        <a href="#" class="hover:text-blue-600">Clubs</a>
        <a href="#" class="hover:text-blue-600">About</a>
        <a href="#" class="hover:text-blue-600">Contact</a>
      </nav>
    </div>
  </header>

  <main class="container overflow-y-auto h-full scroll-hide">
        @yield('content')
      </main>


        <!-- Footer -->
  <footer class="bg-white border-t mt-10">
    <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8 text-gray-700 text-sm">
      <!-- Logo & Description -->
      <div>
        <h2 class="text-xl font-bold text-blue-600 mb-2">Joinify</h2>
        <p>Connecting students to communities, opportunities, and experiences through clubs and organizations.</p>
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
          <li><a href="#" class="hover:text-blue-600">Student Portal</a></li>
          <li><a href="#" class="hover:text-blue-600">Advisor Login</a></li>
          <li><a href="#" class="hover:text-blue-600">Club Guidelines</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div>
        <h3 class="font-semibold mb-2">Contact Us</h3>
        <p>Email: support@joinify.edu</p>
        <p>Phone: (123) 456-7890</p>
        <div class="flex space-x-3 mt-2">
          <!-- Social Icons (placeholders, can use Heroicons or SVGs) -->
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
