<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | @yield('sub-title')</title>
  <link rel="icon" href="/logo.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .scroll-hide {
      scrollbar-width: none;
      -ms-overflow-style: none;
    }

    .scroll-hide::-webkit-scrollbar {
      display: none;
    }
  </style>
</head>

<body class="h-screen w-screen overflow-hidden bg-gray-50 text-gray-800">

  <div class="flex h-full w-full">
    {{-- Sidebar --}}
    <aside class="w-1/5 bg-slate-800 text-white p-6 space-y-8 shadow-lg">
      <a href="/" class="flex items-center space-x-2 text-blue-400 hover:text-blue-500 transition-colors">
        <img src="/logo.png" alt="Joinify Logo" class="h-8 w-8 object-contain">
        <span class="text-2xl font-bold">Joinify</span>
      </a>

      <nav>
        <ul class="space-y-4 text-sm font-medium">
          @if(auth()->user() && auth()->user()->role === 'advisor')

        <li>
        <a href="dashboard" class="flex items-center space-x-2 transition-all duration-200
      {{ Request::is('dashboard') ? 'text-blue-400 font-semibold pointer-events-none' : 'hover:text-blue-300' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"></path>
          </svg>
          <span>Advisor</span>
        </a>
        </li>
      @endif
          @if(auth()->user() && auth()->user()->role === 'president')
        <li>
        <a href="dashboard" class="flex items-center space-x-2 transition-all duration-200
      {{ Request::is('dashboard*') ? 'text-blue-400 font-semibold pointer-events-none' : 'hover:text-blue-300' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M5.121 17.804A3.001 3.001 0 018 15h8a3 3 0 012.879 2.804l.621 7.451A2 2 0 0117.5 27h-11a2 2 0 01-1.998-1.745l.619-7.451z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
          </svg>
          <span>President</span>
        </a>
        </li>
      @endif
          @if(auth()->user() && auth()->user()->role === 'secretary')
        <li>
        <a href="dashboard" class="flex items-center space-x-2 transition-all duration-200
      {{ Request::is('dashboard*') ? 'text-blue-400 font-semibold pointer-events-none' : 'hover:text-blue-300' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4V4z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8M8 12h6m-6 4h4" />
          </svg>
          <span>Secretary</span>
        </a>
        </li>
      @endif
          @if(auth()->user() && auth()->user()->role === 'accountant')

        <li>
        <a href="dashboard" class="flex items-center space-x-2 transition-all duration-200
      {{ Request::is('dashboard') ? 'text-blue-400 font-semibold pointer-events-none' : 'hover:text-blue-300' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M11 11V9a4 4 0 014-4h4m0 0v4m0-4L10 14m-6 4h16v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z" />
          </svg>
          <span>Accountant</span>
        </a>
        </li>
      @endif

          @if(auth()->user() && auth()->user()->role === 'secretary')
          <li>
          <a href="/dashboard/events"
            class="flex items-center space-x-2 transition-all duration-200
        {{ Request::is('dashboard/events*') ? 'text-blue-400 font-semibold pointer-events-none' : 'hover:text-blue-300' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            <span>Events</span>
          </a>
          </li>
      @endif
          @if(auth()->user() && auth()->user()->role === 'accountant')
          <li>
          <a href="/dashboard/members"
            class="flex items-center space-x-2 transition-all duration-200
        {{ Request::is('dashboard/members*') ? 'text-blue-400 font-semibold pointer-events-none' : 'hover:text-blue-300' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 110 8 4 4 0 010-8zM8 7a4 4 0 100 8 4 4 0 000-8z" />
            </svg>
            <span>Membership</span>
          </a>
          </li>
      @endif
          @if(auth()->user() && auth()->user()->role === 'advisor')
          <li>
          <a href="/dashboard/clubs"
            class="flex items-center space-x-2 transition-all duration-200
        {{ Request::is('dashboard/clubs*') ? 'text-blue-400 font-semibold pointer-events-none' : 'hover:text-blue-300' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M8 7V3m8 4V3m-9 9h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span>Clubs</span>
          </a>
          </li>
      @endif

          <li>
            <a href="/dashboard/settings"
              class="flex items-center space-x-2 transition-all duration-200
              {{ Request::is('dashboard/settings') ? 'text-blue-400 font-semibold pointer-events-none' : 'hover:text-blue-300' }}">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9.75 3a2.25 2.25 0 012.25 2.25v.37a7.497 7.497 0 014.86 2.57l.26-.15a2.25 2.25 0 113.18 3.18l-.15.26a7.497 7.497 0 012.57 4.86h.37A2.25 2.25 0 0121 20.25h-.37a7.497 7.497 0 01-2.57 4.86l.15.26a2.25 2.25 0 11-3.18 3.18l-.26-.15a7.497 7.497 0 01-4.86 2.57v.37A2.25 2.25 0 019.75 21h.37a7.497 7.497 0 01-2.57-4.86l-.26.15a2.25 2.25 0 11-3.18-3.18l.15-.26a7.497 7.497 0 01-2.57-4.86H3A2.25 2.25 0 015.25 9.75v-.37a7.497 7.497 0 012.57-4.86l-.15-.26A2.25 2.25 0 017.5 2.25h.37a7.497 7.497 0 014.86 2.57l.26-.15z" />
              </svg>
              <span>Setting</span>
            </a>
          </li>
          <li>
            <a href="/logout" class="flex items-center space-x-2 transition-all duration-200
              {{ Request::is('logout') ? 'text-blue-400 font-semibold pointer-events-none' : 'hover:text-blue-300' }}">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-8V7a2 2 0 114 0v1" />
              </svg>
              <span>Log Out</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    {{-- Main Content Area --}}
    <main class="flex-1 px-8 pt-6 bg-gray-100 overflow-hidden">
      {{-- Header --}}
      <div class="flex justify-between items-center mb-6">
        <div>
          <h1 class="text-3xl font-extrabold text-blue-600">@yield('layout-title')</h1>
          <p class="text-gray-500 mt-1 text-sm">@yield('layout-sub-title')</p>
        </div>
        <div class="flex items-center space-x-4">
          <div class="text-sm text-right">
            <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
          </div>
          <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center">
            <span class="text-blue-600 font-bold">{{ substr(auth()->user()->name, 0, 1) }}
            </span>
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