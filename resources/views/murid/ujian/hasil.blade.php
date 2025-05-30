<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hasil Ujian: {{ $hasilUjian->ujian->nama_ujian }}
        </h2>
    </x-slot>

    <div class="p-6 space-y-6">
        <!-- Ringkasan Nilai -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Ringkasan Nilai</h3>
            <ul class="text-gray-700 space-y-1">
                <li><strong>Nama Ujian:</strong> {{ $hasilUjian->ujian->nama_ujian }}</li>
                <li><strong>Mata Pelajaran:</strong> {{ $hasilUjian->ujian->mataPelajaran->nama_mapel ?? '-' }}</li>
                <li><strong>Nilai Otomatis:</strong> {{ $hasilUjian->nilai_otomatis ?? 0 }}</li>
                <li><strong>Nilai Esai:</strong> {{ $hasilUjian->nilai_esai ?? '-' }}</li>
                <li><strong>Nilai Akhir:</strong> {{ $hasilUjian->nilai_akhir ?? '-' }}</li>
                <li><strong>Status:</strong> 
                    <span class="px-2 py-1 rounded {{ $hasilUjian->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($hasilUjian->status) }}
                    </span>
                </li>
                <li><strong>Jumlah Benar:</strong> {{ $hasilUjian->jumlah_benar }}</li>
                <li><strong>Jumlah Salah:</strong> {{ $hasilUjian->jumlah_salah }}</li>
            </ul>
        </div>

        <!-- Review Jawaban -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Review Jawaban Anda</h3>

            @foreach ($hasilUjian->ujian->soal as $index => $soal)
                <div class="mb-6">
                    <div class="mb-2">
                        <span class="font-semibold">Soal {{ $index + 1 }} ({{ ucfirst($soal->jenis_soal) }})</span>
                        <p class="text-gray-800">{{ $soal->pertanyaan }}</p>
                    </div>

@php
    $jawabanUser = $jawaban->firstWhere('soal_id', $soal->id); 
@endphp

                    @if ($soal->jenis_soal === 'pg')
                        <ul class="space-y-1 mt-2">
                            @foreach ($soal->pilihanJawaban as $pilihan)
                                <li class="flex items-center gap-2">
                                    <input type="radio" disabled
                                        {{ $jawabanUser && $jawabanUser->jawaban_id == $pilihan->id ? 'checked' : '' }}>
                                    <span class="{{ $pilihan->is_benar ? 'text-green-600 font-semibold' : '' }}">
                                        {{ $pilihan->jawaban }}
                                        @if ($pilihan->is_benar)
                                            <span class="ml-1 text-sm text-green-500">(Benar)</span>
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @elseif ($soal->jenis_soal === 'esai')
                        <p class="mt-2 p-3 bg-gray-100 rounded">{{ $jawabanUser->jawaban_isian ?? '-' }}</p>
                    @endif
                </div>
            @endforeach
        </div>
                    <a href="{{ route('murid.ujian.index') }}" class="btn btn-secondary">Kembali ke Daftar Ujian</a>
        
    </div>
</x-app-layout>
