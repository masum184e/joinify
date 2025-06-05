<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - @yield('sub-title')</title>
  <link rel="icon" href="/logo.png" />
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
            float: 'float 6s ease-in-out infinite',
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
    .scroll-hide {
      scrollbar-width: none;
      -ms-overflow-style: none;
    }

    .scroll-hide::-webkit-scrollbar {
      display: none;
    }

    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@300;400;500;600;700;800&display=swap');

    body {
      font-family: 'Inter', sans-serif;
    }

    .font-poppins {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="h-screen w-screen overflow-hidden">

  <div class="flex h-full w-full">
    {{-- Sidebar --}}
    <aside class="hidden md:flex md:flex-col md:w-64 md:fixed md:inset-y-0 z-10 bg-white border-r border-gray-200">
      <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
        <div class="flex items-center flex-shrink-0 px-4 mb-5">
          <a href="/" class="flex items-center space-x-2">
            <div class="h-10 w-10 flex items-center justify-center text-white">
              <img src="/logo.png" alt="Joinify Logo" class="h-8 w-8 object-contain">
            </div>
            <span
              class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 text-transparent bg-clip-text">Joinify</span>
          </a>
        </div>

        <nav class="flex-1 px-2 space-y-1">
          <a href="/dashboard"
            class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-700 {{ Request::is('dashboard') ? 'bg-primary-50 text-primary-600' : 'hover:bg-gray-50 hover:text-primary-600' }}">
            <i
              class="ri-dashboard-line mr-3 text-lg text-gray-400 {{ Request::is('dashboard') ? 'text-primary-600' : 'group-hover:text-primary-600' }} "></i>
            Dashboard
          </a>
          @if(auth()->user()->globalRole && auth()->user()->globalRole->role === 'advisor')
        <a href="/dashboard/clubs"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-700 
      {{ Request::is('dashboard/clubs*') ? 'bg-primary-50 text-primary-600' : 'hover:bg-gray-50 hover:text-primary-600' }}">

        <i
          class="ri-community-line mr-3 text-lg text-gray-400 {{ Request::is('dashboard/clubs*') ? 'text-primary-600' : 'group-hover:text-primary-600' }}"></i>
        Clubs
        </a>
      @endif

          @php
      $clubId = auth()->user()?->clubRoles->first()?->club_id ?? '';
     @endphp

          @if(auth()->user() && auth()->user()->clubRoles->whereIn('role', ['secretary', 'president'])->isNotEmpty())
        <a href="{{ url("dashboard/clubs/{$clubId}/events") }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-700 
      {{ Request::is("dashboard/clubs/{$clubId}/events*") ? 'bg-primary-50 text-primary-600' : 'hover:bg-gray-50 hover:text-primary-600' }}">
        <i
          class="ri-calendar-event-line mr-3 text-lg text-gray-400 
      {{ Request::is("dashboard/clubs/{$clubId}/events*") ? 'text-primary-600' : 'group-hover:text-primary-600' }}"></i>
        Events
        </a>
      @endif

          @if(auth()->user() && auth()->user()->clubRoles->whereIn('role', ['accountant', 'president'])->isNotEmpty())
        <a href="{{ url("dashboard/clubs/{$clubId}/members") }}"
        class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-700 
      {{ Request::is("dashboard/clubs/{$clubId}/members*") ? 'bg-primary-50 text-primary-600' : 'hover:bg-gray-50 hover:text-primary-600' }}">
        <i
          class="ri-user-line mr-3 text-lg text-gray-400 
      {{ Request::is("dashboard/clubs/{$clubId}/members*") ? 'text-primary-600' : 'group-hover:text-primary-600' }}"></i>
        Members
        </a>
      @endif
          <a href="/dashboard/settings"
            class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-700 {{ Request::is('dashboard/settings*') ? 'bg-primary-50 text-primary-600' : 'hover:bg-gray-50 hover:text-primary-600' }}">
            <i
              class="ri-settings-line mr-3 text-lg text-gray-400 {{ Request::is('dashboard/settings*') ? 'text-primary-600' : 'group-hover:text-primary-600' }} "></i>
            Settings
          </a>
        </nav>
      </div>

      <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
        <a href="/logout" class="flex items-center text-sm font-medium text-red-600 hover:text-red-700">
          <i class="ri-logout-box-line mr-2 text-lg"></i>
          Sign Out
        </a>
      </div>
    </aside>


    {{-- Main Content Area --}}
    <main class="flex flex-col flex-1 md:ml-64 flex-1 px-8 pt-6 bg-gray-50 overflow-hidden">
      {{-- Header --}}
      <div class="flex justify-between items-center mb-6">
        <div>
          <h1 class="text-2xl font-bold text-gray-900 font-poppins">@yield('layout-title')</h1>
          <p class="mt-1 text-sm text-gray-500">@yield('layout-sub-title')</p>
        </div>
        <div class="flex items-center space-x-4">
          <div class="text-sm text-right">
            <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
          </div>
          <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center">
            <span class="text-blue-600 font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
          </div>
        </div>
      </div>

      {{-- Scrollable Content --}}
      <div class="container overflow-y-auto h-[calc(100vh-7rem)] scroll-hide pr-2">
        @yield('content')
      </div>
    </main>
  </div>
  @stack('scripts')

</body>

</html>