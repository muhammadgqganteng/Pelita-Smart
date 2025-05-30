<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Kantinku</title>
  @vite(['resources/css/app.css', 'resources/js/app.js']) 
  
  {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}
</head>
<body class="bg-red-50 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-sm p-8 bg-white rounded-lg shadow-lg">
    <div class="flex flex-col items-center mb-6">
      <!-- LOGO -->
      <img src="{{ asset('logo/My.png') }}" alt="Logo Kantinku" class="w-24 h-24 mb-2" />
      <h1 class="text-xl font-bold text-red-600">Welcome Back</h1>
    </div>

    <form method="POST" action="/login">
        @csrf
      <!-- Email -->
      <div class="mb-4">
        <label class="block text-gray-700">
          <div class="flex items-center border rounded px-3 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0h8m-8 0a4 4 0 114-4 4 4 0 01-4 4z" />
            </svg>
            <input type="email" name="email" placeholder="Email" required class="w-full outline-none bg-transparent" />
          </div>
        </label>
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label class="block text-gray-700">
          <div class="flex items-center border rounded px-3 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2m4 0a2 2 0 10-4 0m4 0v2m0 0h-4m4 0a2 2 0 01-2 2m2-2v-2m0 0a2 2 0 012 2v2m0-2a2 2 0 01-2 2" />
            </svg>
            <input type="password" name="password" placeholder="Password" required class="w-full outline-none bg-transparent" />
            <!-- Toggle visibility icon (dummy) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
          </div>
        </label>
      </div>

      <!-- Login Button -->
      <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold">
        Login
      </button>
    </form>

    <!-- Register Link -->
    <p class="mt-4 text-center text-sm text-gray-700">
      Belum punya akun? <a href="/register" class="text-red-600 font-semibold">Daftar</a>
    </p>
  </div>
</body>
</html>

 -->
