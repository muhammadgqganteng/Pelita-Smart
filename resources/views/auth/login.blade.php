<x-guest-layout>
  {{-- <div class="min-h-screen flex items-center justify-center bg-gray-100"> --}}
    <div class="bg-white shadow-md rounded-lg w-full max-w-md p-8">
      <div class="text-center mb-6">
        <img src="{{ asset('images/logo-pelita.png') }}" alt="Pelita Smart" class="mx-auto h-12 w-auto mb-4">
        <h1 class="text-2xl font-semibold">Masuk ke Pelita Smart</h1>
        <p class="text-gray-600 text-sm">Belajar jadi mudah, di mana saja dan kapan saja.</p>
      </div>

      <x-auth-session-status class="mb-4" :status="session('status')" />
          
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                        type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" placeholder="Masukkan email kamu" />
          <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
        </div>

        <div class="mb-4">
          <x-input-label for="password" :value="__('Password')" />
          <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                        type="password" name="password" required autocomplete="current-password"
                        placeholder="Masukkan password" />
          <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between mb-4">
          <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ml-2">Ingat saya</span>
          </label>

          @if (Route::has('password.request'))
            <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
              Lupa password?
            </a>
          @endif
        </div>

      
        <div>
          <x-primary-button class="w-full justify-center py-2">
            {{ __('Masuk') }}
          </x-primary-button>
        </div>

        <div class="mt-4 text-center">
          <span class="text-sm text-gray-600">Belum punya akun?</span>
          <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:text-indigo-800 ml-1">
            Daftar sekarang
          </a>
          <a href="{{ url('/auth/google') }}"
            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-md shadow-sm mt-4">
              <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="h-5 w-5 mr-2">
              Masuk dengan Google
          </a>

        </div>

      </form>
    </div>
  {{-- </div> --}}
</x-guest-layout>
