<x-guest-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-8">
      {{-- Logo dan Judul --}}
      <div class="text-center mb-6">
        <img src="{{ asset('storage/svg/ico.png') }}" alt="Pelita Smart" class="mx-auto h-12 w-auto mb-4">
        <h1 class="text-2xl font-semibold">Daftar Sekarang!</h1>
        <p class="text-gray-600">Belajar sekarang, belajar di mana saja.</p>
      </div>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nama --}}
        <div class="mb-4">
          <x-input-label for="name" :value="__('Nama')" class="block text-sm font-medium text-gray-700" />
          <x-text-input id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        type="text" name="name" :value="old('name')" required autofocus
                        autocomplete="name" placeholder="Masukkan nama kamu" />
          <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
        </div>

        {{-- Email / HP --}}
        <div class="mb-4">
          <x-input-label for="email" :value="__('Email atau Nomor HP')" class="block text-sm font-medium text-gray-700" />
          <x-text-input id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        type="text" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="Masukkan email atau nomor HP" />
          <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
        </div>

        {{-- Password --}}
        <div class="mb-4">
          <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
          <x-text-input id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        type="password" name="password" required autocomplete="new-password"
                        placeholder="Buat password kamu" />
          <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
        </div>

        {{-- Konfirmasi Password --}}
        <div class="mb-4">
          <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="block text-sm font-medium text-gray-700" />
          <x-text-input id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="Masukkan ulang password" />
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-600" />
        </div>

        {{-- Submit Button --}}
        <div class="mt-6">
          <x-primary-button class="w-full py-2">
            {{ __('Daftar') }}
          </x-primary-button>
        </div>

        {{-- Login Link --}}
        <div class="mt-4 text-center">
          <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
            Sudah punya akun? Masuk
          </a>
           <a href="{{ url('/auth/google') }}"
            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-md shadow-sm mt-4">
              <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="h-5 w-5 mr-2">
              Masuk dengan Google
          </a>
        </div>
      </form>
    </div>
  </div>
</x-guest-layout>
