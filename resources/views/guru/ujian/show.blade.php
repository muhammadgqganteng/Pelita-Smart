<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Ujian: {{ $ujian->nama_ujian }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-700 mb-2">Informasi Ujian</h3>

                    <p><strong>Mata Pelajaran:</strong> {{ $ujian->mataPelajaran->nama_mapel ?? '-' }}</p>
                    <p><strong>Kelas:</strong> {{ $ujian->kelas->nama_kelas ?? '-' }}</p>
                    <p><strong>Deskripsi:</strong><br>{{ $ujian->deskripsi ?? '-' }}</p>
                    <p><strong>Tanggal Mulai:</strong> {{ $ujian->tanggal_mulai ? \Carbon\Carbon::parse($ujian->tanggal_mulai)->format('d/m/Y H:i') : '-' }}</p>
                    <p><strong>Tanggal Selesai:</strong> {{ $ujian->tanggal_selesai ? \Carbon\Carbon::parse($ujian->tanggal_selesai)->format('d/m/Y H:i') : '-' }}</p>
                    <p><strong>Waktu Ujian:</strong> {{ $ujian->waktu_ujian ?? '-' }} Menit</p>
                    <p><strong>Jumlah Soal:</strong> {{ $ujian->jumlah_soal ?? 0 }}</p>
                    <p><strong>Jenis Ujian:</strong> {{ ucfirst($ujian->jenis_ujian) }}</p>

                    <p><strong>Status:</strong>
                        @php
                            $badgeClass = match($ujian->status) {
                                'aktif' => 'green',
                                'draft' => 'yellow',
                                'selesai' => 'gray',
                                'arsipkan' => 'red',
                                default => 'blue'
                            };
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-{{ $badgeClass }}-100 text-{{ $badgeClass }}-800">
                            {{ ucfirst($ujian->status) }}
                        </span>
                    </p>

                    <p><strong>Acak Soal:</strong> {{ $ujian->acak_soal ? 'Ya' : 'Tidak' }}</p>
                    <p><strong>Acak Jawaban (PG):</strong> {{ $ujian->acak_jawaban ? 'Ya' : 'Tidak' }}</p>
                    <p><strong>Nilai Lulus:</strong> {{ $ujian->nilai_lulus ?? '-' }}</p>
                    <p><strong>Instruksi Khusus:</strong><br>{{ $ujian->instruksi_khusus ?? '-' }}</p>
                </div>

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('guru.ujian.edit', $ujian->id) }}" class="btn btn-warning">Edit Ujian</a>
                    <a href="{{ route('guru.ujian.soal.index', $ujian->id) }}" class="btn btn-info">Kelola Soal</a>
                    <a href="{{ route('guru.ujian.index') }}" class="btn btn-secondary">Kembali ke Daftar Ujian</a>
                </div>
            </div>
        </div>
    </div>  
</x-app-layout>
