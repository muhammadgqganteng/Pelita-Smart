<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Ujian: {{ $ujian->nama_ujian }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Hasil Ujian: {{ $ujian->nama_ujian }}</h1>
        <div class="mb-4">
            {{-- Pastikan route ini benar mengarah ke index daftar ujian guru --}}
            <a href="{{ route('guru.hasil.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Kembali ke Daftar Ujian
            </a>
        </div>

        <div class="bg-white shadow-md rounded-md overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            #
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Siswa
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nilai
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Waktu Selesai
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Ganti $hasilUjian menjadi $hasilUjianMurid --}}
                    @forelse ($hasilUjianMurid as $hasil)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{-- Akses nama murid melalui relasi 'murid' yang sudah di-eager load --}}
                                {{-- Asumsi kolom nama di tabel 'users' adalah 'name' --}}
                                {{ $hasil->murid->name ?? 'Nama Tidak Ada' }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $hasil->nilai_akhir ?? '-' }} {{-- Gunakan nilai_akhir --}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $hasil->waktu_selesai ? \Carbon\Carbon::parse($hasil->waktu_selesai)->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{-- Contoh link ke detail jawaban per murid. Anda perlu membuat route dan methodnya. --}}
                                <a href="{{ route('guru.hasil.detail_murid', ['ujian' => $ujian->id, 'murid' => $hasil->murid->id]) }}" class="text-indigo-500 hover:underline">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" colspan="5">
                                Belum ada hasil ujian untuk saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{-- Menampilkan pagination links --}}
            {{ $hasilUjianMurid->links() }}
        </div>
    </div>
</x-app-layout>