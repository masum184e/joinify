<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="/logo.png" />
  <title>@yield('title') - @yield('sub-title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#eef2ff',
              100: '#e0e7ff',
              200: '#c7d2fe',
              300: '#a5b4fc',
              400: '#818cf8',
              500: '#6366f1',
              600: '#4f46e5',
              700: '#4338ca',
              800: '#3730a3',
              900: '#312e81',
              950: '#1e1b4b',
            },
            secondary: {
              50: '#fdf4ff',
              100: '#fae8ff',
              200: '#f5d0fe',
              300: '#f0abfc',
              400: '#e879f9',
              500: '#d946ef',
              600: '#c026d3',
              700: '#a21caf',
              800: '#86198f',
              900: '#701a75',
              950: '#4a044e',
            },
            accent: {
              50: '#fff7ed',
              100: '#ffedd5',
              200: '#fed7aa',
              300: '#fdba74',
              400: '#fb923c',
              500: '#f97316',
              600: '#ea580c',
              700: '#c2410c',
              800: '#9a3412',
              900: '#7c2d12',
              950: '#431407',
            }
          },
          animation: {
            'float': 'float 6s ease-in-out infinite',
            'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            'bounce-slow': 'bounce 3s infinite',
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-20px)' },
            }
          },
          backgroundImage: {
            'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
          }
        }
      }
    }
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@300;400;500;600;700;800&display=swap');

    body {
      font-family: 'Inter', sans-serif;
      scroll-behavior: smooth;
    }

    .font-poppins {
      font-family: 'Poppins', sans-serif;
    }

    .clip-path-slant {
      clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }

    .text-gradient {
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
    }

    .card-hover {
      transition: all 0.3s ease;
    }

    .card-hover:hover {
      transform: translateY(-10px);
    }

    .bg-blur {
      backdrop-filter: blur(8px);
    }

    .shadow-glow {
      box-shadow: 0 0 25px rgba(99, 102, 241, 0.3);
    }

    .shadow-glow-accent {
      box-shadow: 0 0 25px rgba(249, 115, 22, 0.3);
    }

    .shadow-glow-secondary {
      box-shadow: 0 0 25px rgba(217, 70, 239, 0.3);
    }

    /* Dropdown styles */
    .dropdown:hover .dropdown-menu {
      display: block;
    }
  </style>
</head>

<body class="bg-gray-50 overflow-x-hidden">

  <!-- Navbar -->
  <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="flex items-center">
          <a href="/" class="flex items-center space-x-2 text-blue-600 hover:text-blue-700">
            <img src="/logo.png" alt="Joinify Logo" class="h-8 w-8 object-contain">
            <span
              class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 text-gradient">Joinify</span>
          </a>
        </div>

        <div class="hidden md:flex items-center space-x-8">
          <a href="/#features" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">Features</a>
          <a href="/#clubs"
            class="text-gray-700 {{ request()->is('clubs*') ? 'text-primary-600 font-semibold' : 'hover:text-primary-600' }} font-medium transition-colors">Clubs</a>
          <a href="/#testimonials"
            class="text-gray-700 hover:text-primary-600 font-medium transition-colors">Testimonials</a>
          <a href="/#about" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">About</a>
        </div>

        <div class="hidden md:flex items-center space-x-4">
          @guest
        <!-- Show for non-authenticated users -->
        <a href="/login" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">Sign In</a>
        <a href="/clubs"
        class="bg-primary-600 hover:bg-primary-700 text-white font-medium px-5 py-2.5 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
        Get Started
        </a>
      @else
        <!-- Show for authenticated users -->
        <div class="flex items-center space-x-4">

        <!-- User Dropdown -->
        <div class="relative dropdown">
          <button class="flex items-center space-x-2 text-gray-700 hover:text-primary-600 transition-colors">
          <img
            src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=6366f1&color=fff' }}"
            alt="{{ Auth::user()->name }}" class="h-8 w-8 rounded-full border-2 border-gray-200">
          <span class="font-medium">{{ Str::limit(Auth::user()->name, 15) }}</span>
          <i class="ri-arrow-down-s-line text-sm"></i>
          </button>

          <!-- Dropdown Menu -->
          <div
          class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
          <div class="px-4 py-2 border-b border-gray-100">
            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
          </div>

          <a href="/dashboard" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
            <i class="ri-dashboard-line mr-3"></i>
            Dashboard
          </a>

          <div class="border-t border-gray-100 mt-2 pt-2">
            <a href="/dashboard/settings"
            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
            <i class="ri-settings-line mr-3"></i>
            Settings
            </a>

            <form method="GET" action="/logout" class="block">
            @csrf
            <button type="submit"
              class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
              <i class="ri-logout-box-line mr-3"></i>
              Sign Out
            </button>
            </form>
          </div>
          </div>
        </div>
        </div>
      @endguest
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
          <button type="button" id="mobile-menu-button" class="text-gray-700 hover:text-primary-600">
            <i class="ri-menu-line text-2xl"></i>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 bg-white/95 backdrop-blur-md">
        <div class="px-4 py-4 space-y-4">
          <a href="/#features"
            class="block text-gray-700 hover:text-primary-600 font-medium transition-colors">Features</a>
          <a href="/#clubs" class="block text-gray-700 hover:text-primary-600 font-medium transition-colors">Clubs</a>
          <a href="/#testimonials"
            class="block text-gray-700 hover:text-primary-600 font-medium transition-colors">Testimonials</a>
          <a href="/#about" class="block text-gray-700 hover:text-primary-600 font-medium transition-colors">About</a>

          @guest
        <div class="border-t border-gray-200 pt-4 space-y-3">
        <a href="/login" class="block text-gray-700 hover:text-primary-600 font-medium transition-colors">Sign
          In</a>
        <a href="/clubs"
          class="block bg-primary-600 hover:bg-primary-700 text-white font-medium px-4 py-2 rounded-lg text-center transition-all duration-300">
          Get Started
        </a>
        </div>
      @else
          <div class="border-t border-gray-200 pt-4 space-y-3">
            <div class="flex items-center space-x-3 pb-3">
              <img
                src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=6366f1&color=fff' }}"
                alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full border-2 border-gray-200">
              <div>
                <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
              </div>
            </div>

            <a href="/dashboard"
              class="block text-gray-700 hover:text-primary-600 font-medium transition-colors">Dashboard</a>
            <a href="" class="block text-gray-700 hover:text-primary-600 font-medium transition-colors">Settings</a>

            <form method="GET" action="/logout" class="pt-2">
              @csrf
              <button type="submit"
                class="block w-full text-left text-red-600 hover:text-red-700 font-medium transition-colors">
                Sign Out
              </button>
            </form>
          </div>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <main class="container overflow-y-auto h-full scroll-hide">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-400 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
        <!-- Logo and Description -->
        <div class="lg:col-span-2">
          <a href="/" class="flex items-center space-x-2 mb-6">
            <div class="h-10 w-10 rounded-lg bg-white flex items-center justify-center text-white">
              <img src="/logo.png" alt="Joinify Logo" class="h-8 w-8 object-contain">
            </div>
            <span class="text-2xl font-bold text-white">Joinify</span>
          </a>
          <p class="mb-6">
            The ultimate platform for campus clubs to organize, connect, and grow their communities with powerful tools.
          </p>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white transition">
              <i class="ri-twitter-fill text-xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition">
              <i class="ri-facebook-fill text-xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition">
              <i class="ri-instagram-fill text-xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition">
              <i class="ri-linkedin-fill text-xl"></i>
            </a>
          </div>
        </div>

        <!-- Links -->
        <div>
          <h3 class="text-white font-semibold mb-4 text-lg">Product</h3>
          <ul class="space-y-3">
            <li><a href="#" class="hover:text-white transition">Features</a></li>
            <li><a href="#" class="hover:text-white transition">Pricing</a></li>
            <li><a href="#" class="hover:text-white transition">Integrations</a></li>
            <li><a href="#" class="hover:text-white transition">Updates</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-white font-semibold mb-4 text-lg">Resources</h3>
          <ul class="space-y-3">
            <li><a href="#" class="hover:text-white transition">Documentation</a></li>
            <li><a href="#" class="hover:text-white transition">Tutorials</a></li>
            <li><a href="#" class="hover:text-white transition">Blog</a></li>
            <li><a href="#" class="hover:text-white transition">Support</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-white font-semibold mb-4 text-lg">Company</h3>
          <ul class="space-y-3">
            <li><a href="#" class="hover:text-white transition">About</a></li>
            <li><a href="#" class="hover:text-white transition">Careers</a></li>
            <li><a href="#" class="hover:text-white transition">Contact</a></li>
            <li><a href="#" class="hover:text-white transition">Legal</a></li>
          </ul>
        </div>
      </div>

      <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
        <p class="text-sm">© {{ date('Y') }} Joinify. All rights reserved.</p>
        <div class="mt-4 md:mt-0 flex space-x-6">
          <a href="#" class="text-sm hover:text-white transition">Privacy Policy</a>
          <a href="#" class="text-sm hover:text-white transition">Terms of Service</a>
          <a href="#" class="text-sm hover:text-white transition">Cookie Policy</a>
        </div>
      </div>
    </div>
  </footer>

  @stack('scripts')

  <!-- Mobile Menu Toggle Script -->
  <script>
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
      const mobileMenu = document.getElementById('mobile-menu');
      mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function (event) {
      const mobileMenu = document.getElementById('mobile-menu');
      const mobileMenuButton = document.getElementById('mobile-menu-button');

      if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
        mobileMenu.classList.add('hidden');
      }
    });
  </script>
</body>

</html>