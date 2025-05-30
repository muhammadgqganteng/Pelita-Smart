<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Saran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">{{ __('Detail Saran') }}</h1>

                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">{{ __('Nama') }}</label>
                        <p class="mt-1 text-gray-900">{{ $kotakSaran->nama }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                        <p class="mt-1 text-gray-900">{{ $kotakSaran->email ?? '-' }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="isi_saran" class="block text-sm font-medium text-gray-700">{{ __('Isi Saran') }}</label>
                        <p class="mt-1 text-gray-900">{{ $kotakSaran->isi_saran }}</p>
                    </div>

<div class="mb-4">
    <label for="created_at" class="block text-sm font-medium text-gray-700">{{ __('Dikirim Pada') }}</label>
    <p class="mt-1 text-gray-900">
        @if ($kotakSaran->created_at)
            {{ $kotakSaran->created_at->format('d F Y, H:i') }}
        @else
            {{ __('Tanggal tidak tersedia') }}
        @endif
    </p>
</div>

                    <div class="flex items-center gap-4">
                        {{-- <a href="{{ route('murid.kotak_saran.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white font-bold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"> --}}
                            {{ __('Kembali') }}
                        {{-- </a> --}}
                        {{-- <form method="POST" action="{{ route('murid.kotak-saran.destroy', ['kotak_saran' => $kotakSaran->id]) }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus saran ini?') }}')">
                                {{ __('Hapus') }}
                            </x-danger-button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>