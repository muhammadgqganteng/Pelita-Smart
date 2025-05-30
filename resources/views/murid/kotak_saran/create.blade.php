<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kirim Saran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">{{ __('Kirimkan Saran Anda') }}</h1>

                    {{-- Untuk menampilkan SEMUA error validasi (REKOMENDASI) --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">{{ __('Oops! Ada yang salah.') }}</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">{{ __('Berhasil!') }}</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('murid.kotak-saran.store') }}" class="space-y-4">
                        @csrf

                        {{-- Input untuk Nama --}}
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">{{ __('Nama Anda') }}</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('nama')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input untuk Email (Opsional) --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email Anda (Opsional)') }}</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('email')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="isi_saran" class="block text-sm font-medium text-gray-700">{{ __('Isi Saran') }}</label>
                            <textarea id="isi_saran" name="isi_saran" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('isi_saran') }}</textarea>
                            @error('isi_saran')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                {{ __('Kirim Saran') }}
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <a href="{{ url()->previous() }}" class="text-blue-500 hover:underline">{{ __('Kembali') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>