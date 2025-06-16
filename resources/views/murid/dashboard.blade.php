<x-app-layout>
    <x-slot name="header">
        <center>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('selamat datang') }} {{ Auth::user()->name }}
            </h2>
        </center>
    </x-slot>

    <div class="py-12">
        <div class="flex min-h-screen bg-gray-100">
            {{-- masih banyak error di project ini  --}}
 
            {{-- Sidebar --}}
<aside class="w-20 bg-white shadow-md flex flex-col items-center py-4 space-y-6 rounded-r-xl">
    <!-- Sidebar Icons with text below and centered -->
    <a href="#" class="flex flex-col items-center space-y-1 text-gray-700 hover:text-blue-600 transition-colors duration-200">
        <img src="/images/svg/icon home.svg" class="w-10 h-10" alt="Beranda" />
        <span class="text-xs font-semibold">beranda</span>
    </a>
    <a href={{Route('jadwal.jadwal')}} class="flex flex-col items-center space-y-1 text-gray-700 hover:text-blue-600 transition-colors duration-200">
        <img src="/images/svg/icon jadwal.svg" class="w-10 h-10" alt="Jadwal" />
        <span class="text-xs font-semibold">jadwal</span>
    </a>
    <a href={{Route('murid.eboks.index')}} class="flex flex-col items-center space-y-1 text-gray-700 hover:text-blue-600 transition-colors duration-200">
        <img src="/images/svg/buku.svg" class="w-10 h-10" alt="Baca Buku" />
        <span class="text-xs font-semibold">baca buku</span>
    </a>
    <a href={{Route('murid.kotak-saran.create')}} class="flex flex-col items-center space-y-1 text-gray-700 hover:text-blue-600 transition-colors duration-200">
        <img src="/images/svg/box.svg" class="w-10 h-10" alt="Kotak Saran" />
        <span class="text-xs font-semibold">kotak saran</span>
    </a>
</aside>


            {{-- Main Content --}}
            <main class="flex-1 p-6 space-y-6 overflow-y-auto">                
                {{-- korosel --}}
         <div class="flex flex-col gap-4 w-full mb-6">
    {{-- korosel --}}
    <x-carousel/>

    {{-- Statistik dan Kalender --}}
    <div class="flex flex-col md:flex-row gap-2 md:gap-3 items-center md:items-stretch w-full justify-between">
        <div class="box bg-white rounded-lg p-4 shadow w-full md:w-1/4">Ujian Terlaksana
            <center>
                <img src="{{ asset('storage/svg/ujian_ter.svg' ) }}" alt="Gambar" class="wit mt-10">
                <p class="text-2xl font-bold text-center mt-4 mr-10">{{ $ujianTerlaksana }}</p>
            </center>
        </div>
        <div class="box bg-white rounded-lg p-4 shadow w-full md:w-1/4">Belum Terlaksana
            <center>
                <img src="{{ asset('storage/svg/belum_Ter.svg' ) }}" alt="Gambar" class="w-86 h-86 mt-10">
            </center>
            <p class="text-2xl font-bold text-center mt-4">{{ $ujianBelumTerlaksana }}</p>
        </div>
        <div class="box bg-white rounded-lg p-4 shadow w-full md:w-1/4">
            <a href="{{Route('murid.ujian.index')}}">lihat ujian</a>
            <center>
                <img src="{{ asset('storage/svg/lihat_ujian.svg') }}" alt="Gambar" class=" mt-8">
            </center>
            <p class="text-2xl font-bold text-center mt-4">{{  $semuaUjian }}</p>
        </div>
        <div class="w-full md:w-1/4">
            <x-kalender/>
        </div>
    </div>
</div>


                {{-- Tugas --}}
 
                <x-tugas/>

                {{-- Latihan Soal --}}
                <div class="bg-white rounded-lg p-4 shadow">
                    <h2 class="text-lg font-semibold mb-2">Latihan Soal</h2>
                    <div class="flex justify-between items-center">
                        <p>Pendidikan nama_matri - 5 Soal</p>
                        <button class="bg-orange-400 px-4 py-2 text-white rounded-lg">Mulai</button>
                    </div>
                </div>

                {{-- Konten Belajar dan Kehadiran --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-3 grid grid-cols-2 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow">Buku Digital</div>
                        <div class="bg-white p-4 rounded-lg shadow">Konten Interaktif</div>
                        <div class="bg-white p-4 rounded-lg shadow">Video</div>
                        <div class="bg-white p-4 rounded-lg shadow">Lab Digital</div>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow">
                        <h2 class="text-lg font-semibold mb-2">Kehadiran</h2>
                        <p> Kehadiran Chart atau diagram   </p>
                    </div>
                </div>

            </main>
        </div>


    </div>
</x-app-layout>