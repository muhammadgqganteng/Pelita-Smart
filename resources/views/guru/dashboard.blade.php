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

            {{-- Sidebar --}}
<aside class="w-20 bg-white shadow-md flex flex-col items-center py-6 space-y-6 rounded-r-xl">
  <!-- Sidebar Icons with Text Below -->
  <a href="#" class="flex flex-col items-center space-y-1 w-full px-2 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
    <img src="/images/svg/icon home.svg" alt="Beranda" class="w-10 h-10" />
    <span class="text-gray-700 text-xs font-medium text-center">Beranda</span>
  </a>
  <a href="{{ Route('guru.tugas.index') }}" class="flex flex-col items-center space-y-1 w-full px-2 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
    <img src="/images/svg/icon jadwal.svg" alt="Buat Tugas" class="w-10 h-10" />
    <span class="text-gray-700 text-xs font-medium text-center">Buat Tugas</span>
  </a>
  <a href="{{ Route('guru.banksoal.index') }}" class="flex flex-col items-center space-y-1 w-full px-2 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
    <img src="/images/svg/mark.svg" alt="Nilai" class="w-10 h-10" />
    <span class="text-gray-700 text-xs font-medium text-center">Nilai</span>
  </a>
  <a href="{{ Route('guru.ujian.index') }}" class="flex flex-col items-center space-y-1 w-full px-2 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
    <img src="/images/svg/box.svg" alt="Buat Ujian" class="w-10 h-10" />
    <span class="text-gray-700 text-xs font-medium text-center">Buat Ujian</span>
  </a>
  
  {{-- <a href="{{ route('guru.ujian.soal.index', $ujian->id) }}" class="flex flex-col items-center space-y-1 w-full px-2 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
    <img src="/images/svg/box.svg" alt="Lihat" class="w-10 h-10" />
    <span class="text-gray-700 text-xs font-medium text-center">Lihat</span>
  </a>  --}}
     <a href="{{ route('guru.hasil.index') }}" class="flex flex-col items-center space-y-1 w-full px-2 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
    <img src="/images/svg/box.svg" alt="Lihat" class="w-10 h-10" />
    <span class="text-gray-700 text-xs font-medium text-center">Lihat</span>
  </a>  
  
</aside>



            {{-- masih banyak error  --}}


            {{-- Main Content --}}
            <main class="flex-1 p-6 space-y-6 overflow-y-auto">

                <div class="flex flex-col md:flex-row gap-3 md:gap-3 item-center w-full md:justify-between  mb-6">

                    <div class="box self-end bg-white rounded-lg p-4 shadow gap-3">Ujian Terlaksana
                        <center>
                             <img src="{{ asset('storage/svg/ujian_ter.svg' ) }}" alt="Gambar" class="wit mt-10 g">
                                 
                    </div>
                    <div class="box self-end bg-white rounded-lg p-4 shadow">Belum Terlaksana
                        <center>
                                 <img src="{{ asset('storage/svg/belum_Ter.svg' ) }}" alt="Gambar" class="w-86 h-86 mt-10">

                        </center>


                    </div>
                    <div class="box self-end bg-white rounded-lg p-4 shadow"><a
                            href="{{Route('jadwal.jadwal_ujian')}}">lihat ujian</a>
                        <center>
                                 <x-lihat_ujian/>
                        </center>
                    </div>
                    <x-kalender />

                </div>

                {{-- Tugas --}}
                <div class="bg-white rounded-lg p-4 shadow">
                    <h2 class="tewt-lg font-semibold mb-2">Tugas</h2>
                    <p>Data belum tersedia.</p>
                </div>

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
                        <p>Chart atau diagram bisa di sini</p>
                    </div>
                </div>

            </main>
        </div>


    </div>
</x-app-layout>