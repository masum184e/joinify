<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* resources/css/app.css */
.scroll-hide {
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none;  /* IE and Edge */
  }
  
  .scroll-hide::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
  }
    </style>
</head>
<body class="h-screen w-screen overflow-hidden">

  <div class="flex h-full w-full">
    {{-- Sidebar --}}
    <aside class="w-1/5 bg-slate-900 text-white p-5 space-y-6">
      <div class="text-2xl text-teal-600 font-bold">Joinify</div>
      <nav class="space-y-3">
        <ul class="space-y-2">
          <li><a class="block py-1 hover:text-teal-600" href="/dashboard">Dashboard</a></li>
          <li><a class="block py-1 hover:text-teal-600" href="/dashboard/manage-clubs">Manage Clubs</a></li>
        </ul>
      </nav>
    </aside>

    {{-- Main content area --}}
    <main class="flex-1 p-8 bg-gray-100 space-y-6 ">
      
      {{-- Header --}}
      <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold">@yield('title', 'Dashboard')</h2>
        <div class="flex items-center space-x-4">
          <div class="w-10 h-10 rounded-full bg-gray-300"></div>
        </div>
      </div>

      {{-- Scrollable Content --}}
      <div class="container overflow-y-auto h-full scroll-hide">
        @yield('content')
      </div>

    </main>
  </div>

</body>
</html>
