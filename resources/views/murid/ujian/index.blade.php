<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ujian') }}
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <div class="bg-white rounded-lg shadow-md p-6">

            {{-- Title --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">📚 Daftar Ujian Tersedia</h1>
                <p class="text-gray-500 text-sm mt-1">Pilih ujian yang ingin kamu ikuti dari daftar di bawah ini.</p>
            </div>

            {{-- Daftar Ujian --}}
     <div class="space-y-4">
    @forelse ($ujian as $ujian)
        <div class="border border-gray-200 rounded-md p-4 shadow-sm hover:shadow-md transition duration-200">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">{{ $ujian->nama_ujian }}</h2>
                    <p class="text-sm text-gray-500">
                        Mata Pelajaran: {{ $ujian->mataPelajaran->nama_mapel ?? '-' }}
                    </p>

                    @if ($ujian->tanggal_mulai && $ujian->tanggal_selesai)
                        <p class="text-sm text-gray-500">
                            Waktu: {{ \Carbon\Carbon::parse($ujian->tanggal_mulai)->format('d/m/Y H:i') }} - {{ \Carbon\Carbon::parse($ujian->tanggal_selesai)->format('d/m/Y H:i') }}
                        </p>
                    @elseif ($ujian->tanggal_mulai)
                        <p class="text-sm text-gray-500">
                            Mulai: {{ \Carbon\Carbon::parse($ujian->tanggal_mulai)->format('d/m/Y H:i') }}
                        </p>
                    @elseif ($ujian->tanggal_selesai)
                        <p class="text-sm text-gray-500">
                            Selesai: {{ \Carbon\Carbon::parse($ujian->tanggal_selesai)->format('d/m/Y H:i') }}
                        </p>
                    @else
                        <p class="text-sm text-gray-500">Waktu: Fleksibel</p>
                    @endif
                </div>
                <div>
                    @php
                        $hasil = \App\Models\HasilUjian::where('ujian_id', $ujian->id)
                                                        ->where('user_id', Auth::id())
                                                        ->first();
                    @endphp
                    @if ($hasil)
                        <span class="bg-green-200 text-green-700 text-sm font-semibold py-2 px-4 rounded">Ujian Selesai</span>
                    @else
                        <a href="{{ route('murid.ujian.show', $ujian->id) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold py-2 px-4 rounded transition duration-200">
                            🚀 Mulai Ujian
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="text-center text-gray-500 py-6">
            Tidak ada ujian yang tersedia saat ini.
        </div>
    @endforelse
</div>
            </div>

        </div>
    </div>
</x-app-layout>
