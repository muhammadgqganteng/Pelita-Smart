   <x-app-layout>
   {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Ujian: {{ $ujian->nama_ujian }}
        </h2>
    </x-slot> --}}
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Hasil Ujian</h1>

        @if (session('success'))
            <div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">{{ session('success') }}</strong>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path fill-rule="evenodd" d="M18 5.414L14.414 2 13 3.414 16.586 7 13 10.586 14.414 12 18 8.414 19.414 7 18 5.414z"/></svg>
                </span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-md overflow-hidden">
            <div class="p-4">
                <h2 class="text-lg font-medium mb-2">Pilih Ujian untuk Melihat Hasil</h2>
                <ul class="list-none">
                    @forelse ($ujians as $ujian)
                        <li class="py-2 border-b border-gray-200 last:border-b-0">
                            <a href="{{ route('guru.hasil.show', $ujian->id) }}" class="text-blue-500 hover:underline-hover">
                                {{ $ujian->nama_ujian }}
                            </a>
                            <span class="text-gray-500 text-sm ml-2">({{ $ujian->mataPelajaran->nama_mapel ?? 'Mata Pelajaran Tidak Ada' }})</span>
                        </li>
                    @empty
                        <li>Tidak ada ujian yang ditemukan.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
   </x-app-layout>