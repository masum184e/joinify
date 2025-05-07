<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Joinify</title>
  <link rel="icon" href="/logo.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'float': 'float 6s ease-in-out infinite',
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-20px)' },
            }
          }
        }
      }
    }
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@300;400;500;600;700;800&display=swap');

    body {
      font-family: 'Inter', sans-serif;
    }

    .font-poppins {
      font-family: 'Poppins', sans-serif;
    }

    .bg-gradient {
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #c026d3 100%);
    }
  </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
  <div class="flex w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden">
    <!-- Login Form Section -->
    <div class="w-full md:w-3/5 p-8 md:p-12">
      <div class="mb-8">
        <a href="/" class="flex items-center space-x-2 mb-10">
          <div class="h-10 w-10 rounded-lg flex items-center justify-center text-white">
            <img src="/logo.png" alt="Joinify Logo" class="h-8 w-8 object-contain">
          </div>
          <span
            class="text-2xl font-bold bg-gradient-to-r from-[#4f46e5] to-[#c026d3] text-transparent bg-clip-text">Joinify</span>
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mb-2 font-poppins">Welcome Back!</h1>
        <p class="text-gray-600">Sign in to your account to continue</p>
      </div>

      <form action="/login" method="POST" id="login-form">
        @csrf
        <div class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ri-mail-line text-gray-400"></i>
              </div>
              <input type="email" id="email" name="email" placeholder="you@university.edu"
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6366f1] focus:border-[#6366f1] transition-all" />
              @error('email')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between mb-1">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <a href="#" class="text-sm text-[#4f46e5] hover:text-[#4338ca]">Forgot password?</a>
            </div>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ri-lock-line text-gray-400"></i>
              </div>
              <input type="password" id="password" name="password" placeholder="••••••••"
                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#6366f1] focus:border-[#6366f1] transition-all" />
              @error('password')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
            </div>
          </div>

          <div class="flex items-center">
            <input type="checkbox" id="remember" name="remember"
              class="h-4 w-4 text-[#4f46e5] focus:ring-[#6366f1] border-gray-300 rounded" />
            <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
          </div>

          @if (session('error'))
            <div class="text-red-500 mb-4">{{ session('error') }}</div>
          @endif

          @if ($errors->any())
            <ul class="text-red-500 mb-4">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif

          <div>
            <button type="submit"
              class="w-full bg-[#4f46e5] hover:bg-[#4338ca] text-white font-medium py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
              Sign In
            </button>
          </div>
        </div>
      </form>

    </div>

    <!-- Image/Info Section -->
    <div class="hidden md:block md:w-2/5 bg-gradient relative overflow-hidden">
      <div class="absolute inset-0 bg-black opacity-20"></div>

      <!-- Animated Shapes -->
      <div class="absolute top-20 right-10 w-40 h-40 bg-white rounded-full mix-blend-overlay opacity-10 animate-float">
      </div>
      <div class="absolute bottom-20 left-10 w-40 h-40 bg-white rounded-full mix-blend-overlay opacity-10 animate-float"
        style="animation-delay: 1s;"></div>

      <div class="relative h-full flex flex-col justify-center px-12 text-white z-10">
        <div class="mb-6">
          <h2 class="text-3xl font-bold mb-2 font-poppins">Joinify</h2>
          <p class="text-white/80 text-lg">The ultimate platform for campus clubs</p>
        </div>

        <div class="space-y-6">
          <div class="flex items-start">
            <div
              class="flex-shrink-0 h-10 w-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mr-4">
              <i class="ri-team-line"></i>
            </div>
            <p class="text-white/80">Connect with like-minded students and build your community</p>
          </div>

          <div class="flex items-start">
            <div
              class="flex-shrink-0 h-10 w-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mr-4">
              <i class="ri-calendar-event-line"></i>
            </div>
            <p class="text-white/80">Organize and discover exciting campus events</p>
          </div>

          <div class="flex items-start">
            <div
              class="flex-shrink-0 h-10 w-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mr-4">
              <i class="ri-rocket-line"></i>
            </div>
            <p class="text-white/80">Grow your skills and pursue your passions</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>