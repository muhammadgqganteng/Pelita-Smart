<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Jadwal
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <!-- Tambahkan kelas max-w-full dan w-full agar kontennya lebar -->
        <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-full">
            {{-- Tab Header --}}
            <div class="flex border-b mb-6 space-x-6 text-gray-700 font-semibold overflow-x-auto">
                <a href="{{ Route('jadwal.jadwal') }}" class="border-b-2 border-blue-500 text-blue-600 pb-2 tracking-wide whitespace-nowrap">Jadwal Pelajaran</a>
                <a href="{{ Route('jadwal.jadwal_ujian') }}" class="border-b-2 border-blue-500 text-blue-600 pb-2 tracking-wide whitespace-nowrap">Jadwal Ujian</a>
                <a href="{{ Route('jadwal.riwayat_ujian') }}" class="border-b-2 border-blue-500 text-blue-600 pb-2 tracking-wide whitespace-nowrap">Riwayat Ujian</a>
            </div>

            {{-- Content Box --}}
            <div class="flex flex-col items-center justify-center h-64 text-center space-y-2">
                <img src="/images/empty-state.png" alt="Ilustrasi Kosong" class="w-40 h-40" />
                <h3 class="text-lg font-semibold text-gray-700">Data Belum Tersedia</h3>
                <p class="text-sm text-gray-500">Belum ada jadwal pelajaran untuk saat ini.</p>
            </div>
        </div>
    </div>
</x-app-layout>
