<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Joinify | Login</title>
  <link rel="icon" href="/logo.png" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">

    <!-- Login Section -->
    <div class="w-2/3 p-10">
      <h2 class="text-3xl font-extrabold text-gray-800 mb-6">🔐 Login to Your Account</h2>

      <form action="/login" method="POST" id="login-form">
        @csrf
        <input type="email" placeholder="Email" name="email"
          class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required />
        @error('email')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
        <input type="password" placeholder="Password" name="password"
          class="w-full p-3 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required />
        @error('password')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg">Sign In</button>
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

      </form>
    </div>

    <!-- Admin Information Section -->
    <div
      class="w-1/3 bg-gradient-to-br from-blue-400 to-blue-600 text-white flex flex-col items-center justify-center p-10">
      <a href="/" class="flex items-center space-x-2 text-blue-600 hover:text-blue-700">
        <img src="/logo.png" alt="Joinify Logo" class="h-10 w-10 object-contain">
        <span class="text-4xl font-bold text-white">Joinify</span>
      </a>
      <p class="text-sm mb-6 text-center px-4">Sign in and discover a great amount of new opportunities!</p>

      <a class="text-white text-sm underline" href="/forgot-password">Forgot Password?</a>
    </div>

  </div>

</body>

</html>