<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
    
    <!-- Login Section -->
    <div class="w-2/3 p-10">
      <h2 class="text-2xl font-bold mb-4">Login to Your Account</h2>

      <form action="/dashboard" >
        <input type="email" placeholder="Email" class="w-full p-3 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" />
        <input type="password" placeholder="Password" class="w-full p-3 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" />
        <button class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-lg">Sign In</button>
      </form>
    </div>

    <!-- Signup Prompt Section -->
    <div class="w-1/3 bg-gradient-to-br from-teal-400 to-teal-600 text-white flex flex-col items-center justify-center p-10">
      <h3 class="text-xl font-bold mb-2">New Here?</h3>
      <p class="text-sm mb-6 text-center">Sign up and discover a great amount of new opportunities!</p>
      <a class="bg-white text-teal-600 font-semibold px-6 py-2 rounded-full shadow hover:bg-gray-100" href="/registration">Sign Up</a>
    </div>
    
  </div>

</body>
</html>
