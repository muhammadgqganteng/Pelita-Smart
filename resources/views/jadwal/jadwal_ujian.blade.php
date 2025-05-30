<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Jadwal ujian
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <div class="bg-white rounded-lg shadow-md p-6">

            {{-- Tab Menu --}}
            <div class="flex border-b mb-4 space-x-6 text-gray-700 font-semibold">
                <a href="{{route('jadwal.jadwal')}}" class="pb-2 hover:text-blue-500">Jadwal Pelajaran</a>
                <a href="{{{Route('jadwal.jadwal_ujian')}}}" class="pb-2 hover:text-blue-500">Jadwal Ujian</a>
                <a href="{{Route('jadwal.riwayat_ujian')}}" class="border-b-2 border-blue-500 text-blue-600 pb-2">Riwayat Ujian</a>
            </div>

            {{-- Filter --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <input type="date" class="border-gray-300 rounded-md shadow-sm" placeholder="Tanggal Ujian">
                <select class="border-gray-300 rounded-md shadow-sm">
                    <option>Mata Pelajaran</option>
                </select>
                <select class="border-gray-300 rounded-md shadow-sm">
                    <option>Jenis Ujian</option>
                </select>
                <input type="text" placeholder="Cari nama paket soal" class="border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border">
                    <thead class="bg-blue-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-2 border">No.</th>
                            <th class="px-4 py-2 border">Waktu Pelaksanaan</th>
                            <th class="px-4 py-2 border">Nama Paket Soal</th>
                            <th class="px-4 py-2 border">Mata Pelajaran</th>
                            <th class="px-4 py-2 border">Jenis Ujian</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        {{-- Contoh baris statis, nanti diganti loop dari database --}}
                        <tr>
                            <td class="px-4 py-2 border">1</td>
                            <td class="px-4 py-2 border">Kamis, 28 Maret 2024<br>11.00 - 12.50</td>
                            <td class="px-4 py-2 border">USBK</td>
                            <td class="px-4 py-2 border">Produk Kreatif dan Kewirausahaan</td>
                            <td class="px-4 py-2 border">USBK</td>
                            <td class="px-4 py-2 border">
                                <button class="bg-orange-400 text-white px-3 py-1 rounded flex items-center gap-1">
                                    👁️ mulai ujian
                                </button>
                            </td>
                        </tr>
                        <!-- Tambah baris lain di sini jika perlu -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
