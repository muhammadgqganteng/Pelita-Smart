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
  <a href="{{ Route('jadwal.jadwal') }}" class="flex flex-col items-center space-y-1 w-full px-2 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
    <img src="/images/svg/icon jadwal.svg" alt="Jadwal" class="w-10 h-10" />
    <span class="text-gray-700 text-xs font-medium text-center">Jadwal</span>
  </a>
  <a href="#" class="flex flex-col items-center space-y-1 w-full px-2 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
    <img src="/images/svg/mark.svg" alt="Nilai" class="w-10 h-10" />
    <span class="text-gray-700 text-xs font-medium text-center">Nilai</span>
  </a>
  <a href="{{ Route('admin.akun.index') }}" class="flex flex-col items-center space-y-1 w-full px-2 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
    <img src="/images/svg/mark.svg" alt="Master Akun" class="w-10 h-10" />
    <span class="text-gray-700 text-xs font-medium text-center">Master Akun</span>
  </a>
  <a href="#" class="flex flex-col items-center space-y-1 w-full px-2 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
    <img src="/images/svg/box.svg" alt="Kotak Saran" class="w-10 h-10" />
    <span class="text-gray-700 text-xs font-medium text-center">Kotak Saran</span>
  </a>
</aside>




            {{-- Main Content --}} 
            {{-- masih banyak error  --}}
            <main class="flex-1 p-6 space-y-6 overflow-y-auto">

                <div class="flex flex-col md:flex-row gap-2 md:gap-0 item-center w-full md:justify-between mb-6">
                    {{-- Statistik dan Kalender --}}
                    {{-- <div class="flex flex-row justify-between  self-end gap-4  "> --}}
                        <div class="box self-end bg-white rounded-lg p-4 shadow">Ujian Terlaksana
                            <center>
                                <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="92px" height="92px"
                                    viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"
                                    fill="#000000" class="mt-4">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <g>
                                                <path fill="#B4CCB9"
                                                    d="M32.516,53.933C32.347,53.978,32.173,54,32,54s-0.347-0.022-0.516-0.067L2,46.07v1.954l30,7.941l30-7.941 V46.07L32.516,53.933z">
                                                </path>
                                                <path fill="#B4CCB9"
                                                    d="M32,58c-0.086,0-0.172-0.011-0.256-0.033L2,50.093v1.906l25.033,6.676l1.987,0.53 c0.079,1.143,0.785,2.111,1.788,2.546l0.676,0.181c0.169,0.045,0.343,0.067,0.516,0.067s0.347-0.022,0.516-0.067l0.676-0.181 c1.003-0.435,1.709-1.403,1.788-2.546l1.987-0.53L62,51.999v-1.906l-29.744,7.874C32.172,57.989,32.086,58,32,58z">
                                                </path>
                                            </g>
                                            <g>
                                                <polygon fill="#F9EBB2"
                                                    points="2.001,2.001 1.998,2.001 2,44 31,51.733 31,9.733 2.001,2 ">
                                                </polygon>
                                                <polygon fill="#F9EBB2" points="33,9.733 33,51.733 62,44 62,2 ">
                                                </polygon>
                                            </g>
                                            <polygon opacity="0.15" fill="#231F20"
                                                points="33,9.733 33,51.733 62,44 62,2 ">
                                            </polygon>
                                            <g>
                                                <path fill="#394240"
                                                    d="M8.992,29.828l14.467,4.134C23.551,33.987,23.643,34,23.734,34c0.435,0,0.835-0.286,0.961-0.726 c0.151-0.53-0.156-1.084-0.688-1.236L9.541,27.904c-0.527-0.146-1.084,0.155-1.236,0.688C8.153,29.122,8.461,29.676,8.992,29.828z ">
                                                </path>
                                                <path fill="#394240"
                                                    d="M8.992,36.829l14.467,4.133C23.551,40.987,23.643,41,23.734,41c0.435,0,0.835-0.286,0.961-0.726 c0.151-0.531-0.156-1.084-0.688-1.236L9.541,34.905c-0.527-0.146-1.084,0.155-1.236,0.688C8.153,36.124,8.461,36.677,8.992,36.829 z">
                                                </path>
                                                <path fill="#394240"
                                                    d="M8.992,22.828l14.467,4.134C23.551,26.987,23.643,27,23.734,27c0.435,0,0.835-0.286,0.961-0.726 c0.151-0.53-0.156-1.084-0.688-1.236L9.541,20.904c-0.527-0.146-1.084,0.155-1.236,0.688C8.153,22.122,8.461,22.676,8.992,22.828z ">
                                                </path>
                                                <path fill="#394240"
                                                    d="M8.992,15.828l14.467,4.134C23.551,19.987,23.643,20,23.734,20c0.435,0,0.835-0.286,0.961-0.726 c0.151-0.53-0.156-1.084-0.688-1.236L9.541,13.904c-0.527-0.146-1.084,0.155-1.236,0.688C8.153,15.122,8.461,15.676,8.992,15.828z ">
                                                </path>
                                                <path fill="#394240"
                                                    d="M39.963,33.962c0.092,0,0.184-0.013,0.275-0.038l14.467-4.134c0.531-0.152,0.839-0.706,0.688-1.236 c-0.152-0.532-0.708-0.832-1.236-0.688L39.689,32c-0.531,0.152-0.839,0.706-0.688,1.236 C39.128,33.676,39.528,33.962,39.963,33.962z">
                                                </path>
                                                <path fill="#394240"
                                                    d="M54.459,34.905l-14.467,4.133c-0.531,0.152-0.839,0.705-0.688,1.236C39.431,40.714,39.831,41,40.266,41 c0.092,0,0.184-0.013,0.275-0.038l14.467-4.133c0.531-0.152,0.839-0.705,0.688-1.236C55.543,35.061,54.987,34.761,54.459,34.905z">
                                                </path>
                                                <path fill="#394240"
                                                    d="M40.266,27c0.092,0,0.184-0.013,0.275-0.038l14.467-4.134c0.531-0.152,0.839-0.706,0.688-1.236 c-0.152-0.532-0.708-0.834-1.236-0.688l-14.467,4.134c-0.531,0.152-0.839,0.706-0.688,1.236C39.431,26.714,39.831,27,40.266,27z">
                                                </path>
                                                <path fill="#394240"
                                                    d="M40.266,20c0.092,0,0.184-0.013,0.275-0.038l14.467-4.134c0.531-0.152,0.839-0.706,0.688-1.236 c-0.152-0.532-0.708-0.832-1.236-0.688l-14.467,4.134c-0.531,0.152-0.839,0.706-0.688,1.236C39.431,19.714,39.831,20,40.266,20z">
                                                </path>
                                                <path fill="#394240"
                                                    d="M63.219,0.414c-0.354-0.271-0.784-0.413-1.221-0.413c-0.172,0-0.345,0.022-0.514,0.066L32,7.93 L2.516,0.067c-0.17-0.045-0.343-0.066-0.515-0.066c-0.437,0-0.866,0.142-1.22,0.413C0.289,0.793,0,1.379,0,2v49.999 c0,0.906,0.609,1.699,1.484,1.933l25.873,6.899C28.089,62.685,29.887,64,32,64s3.911-1.315,4.643-3.169l25.873-6.899 C63.391,53.698,64,52.905,64,51.999V2C64,1.379,63.711,0.793,63.219,0.414z M2.001,2.001L2.001,2.001L31,9.733v42L2,44 L1.998,2.001C1.998,2.001,1.999,2.001,2.001,2.001z M62,51.999l-25.033,6.676l-1.987,0.53c-0.079,1.143-0.785,2.111-1.788,2.546 l-0.676,0.181c-0.169,0.045-0.343,0.067-0.516,0.067s-0.347-0.022-0.516-0.067l-0.676-0.181c-1.003-0.435-1.709-1.403-1.788-2.546 l-1.987-0.53L2,51.999v-1.906l29.744,7.874C31.828,57.989,31.914,58,32,58s0.172-0.011,0.256-0.033L62,50.093V51.999z M62,48.024 l-30,7.941L2,48.024V46.07l29.484,7.862C31.653,53.978,31.827,54,32,54s0.347-0.022,0.516-0.067L62,46.07V48.024z M62,44 l-29,7.733v-42L62,2V44z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                        </div>
                        <div class="box  self-end bg-white rounded-lg p-4 shadow">Belum Terlaksana
                            <center>
                                <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="86px" height="86px"
                                    viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"
                                    fill="#000000" class="mt-4">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path fill="#F9EBB2" d="M56,62H10c-2.209,0-4-1.791-4-4s1.791-4,4-4h46V62z">
                                            </path>
                                            <g>
                                                <path fill="#45AAB8"
                                                    d="M6,4v49.537C7.062,52.584,8.461,52,10,52h2V2H8C6.896,2,6,2.896,6,4z">
                                                </path>
                                                <path fill="#45AAB8" d="M56,2H14v50h42h2v-2V4C58,2.896,57.104,2,56,2z">
                                                </path>
                                            </g>
                                            <g>
                                                <path fill="#394240"
                                                    d="M60,52V4c0-2.211-1.789-4-4-4H8C5.789,0,4,1.789,4,4v54c0,3.313,2.687,6,6,6h49c0.553,0,1-0.447,1-1 s-0.447-1-1-1h-1v-8C59.104,54,60,53.104,60,52z M6,4c0-1.104,0.896-2,2-2h4v50h-2c-1.539,0-2.938,0.584-4,1.537V4z M56,62H10 c-2.209,0-4-1.791-4-4s1.791-4,4-4h46V62z M56,52H14V2h42c1.104,0,2,0.896,2,2v46v2H56z">
                                                </path>
                                                <path fill="#394240"
                                                    d="M43,26H23c-0.553,0-1,0.447-1,1s0.447,1,1,1h20c0.553,0,1-0.447,1-1S43.553,26,43,26z">
                                                </path>
                                                <path fill="#394240"
                                                    d="M49,20H23c-0.553,0-1,0.447-1,1s0.447,1,1,1h26c0.553,0,1-0.447,1-1S49.553,20,49,20z">
                                                </path>
                                                <path fill="#394240"
                                                    d="M23,16h12c0.553,0,1-0.447,1-1s-0.447-1-1-1H23c-0.553,0-1,0.447-1,1S22.447,16,23,16z">
                                                </path>
                                            </g>
                                            <path opacity="0.2" fill="#231F20"
                                                d="M6,4v49.537C7.062,52.584,8.461,52,10,52h2V2H8C6.896,2,6,2.896,6,4z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </center>


                        </div>
                        <div class="box self-end bg-white rounded-lg p-4 shadow"><a
                                href="{{Route('jadwal.jadwal_ujian')}}">lihat ujian</a>
                            <center>
                                <svg height="100px" width="100px" version="1.1" id="Layer_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="-51.2 -51.2 614.40 614.40" xml:space="preserve" fill="#000000"
                                    class="mt-3">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0">
                                        <path transform="translate(-51.2, -51.2), scale(19.2)"
                                            d="M16,29.11079840688035C19.697499200498402,28.79404206488261,22.33598109984485,25.788207757723534,24.44540335077199,22.734984430618947C26.334173737129095,20.001137378121417,27.049771523339253,16.855163888723787,26.7538005675733,13.545515195558306C26.378437388599924,9.34807544496978,26.40886670420808,4.098471761826348,22.61477556936013,2.2642769966997367C18.81898640901168,0.42926134736835286,14.662328201145467,3.6243974053698285,11.195965831784303,6.024320259835516C8.524933476823659,7.873599391857927,7.014802774989469,10.626472590685145,6.054192072123271,13.729934242924315C4.950901487193705,17.294354263843406,3.495663802756944,21.222867168859665,5.5217426791795425,24.356131375216545C7.712928265000162,27.744727666027913,11.97939767721001,29.455234258069414,16,29.11079840688035"
                                            fill="#7ed0ec" strokewidth="0"></path>
                                    </g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g transform="translate(1 1)">
                                            <polygon style="fill:#dac3c3;"
                                                points="101.4,493.933 75.8,476.867 50.2,493.933 50.2,451.267 101.4,451.267 ">
                                            </polygon>
                                            <path style="fill:#dedede;"
                                                d="M169.667,451.267h-153.6V7.533h153.6c14.507,0,25.6,11.093,25.6,25.6v392.533 C195.267,440.173,184.173,451.267,169.667,451.267">
                                            </path>
                                            <path style="fill:#CCCCCC;"
                                                d="M340.333,451.267h-153.6V7.533h153.6c14.507,0,25.6,11.093,25.6,25.6v392.533 C365.933,440.173,354.84,451.267,340.333,451.267">
                                            </path>
                                            <path style="fill:#E2E3E5;"
                                                d="M314.733,451.267H41.667V7.533h273.067c14.507,0,25.6,11.093,25.6,25.6v392.533 C340.333,440.173,329.24,451.267,314.733,451.267">
                                            </path>
                                            <g>
                                                <polygon style="fill:#dac3c3;"
                                                    points="272.067,451.267 314.733,451.267 314.733,7.533 272.067,7.533 ">
                                                </polygon>
                                                <path style="fill:#dac3c3;"
                                                    d="M493.933,425.667L459.8,485.4l-34.133-59.733V24.6c0-9.387,7.68-17.067,17.067-17.067h34.133 c9.387,0,17.067,7.68,17.067,17.067V425.667z">
                                                </path>
                                            </g>
                                            <polygon style="fill:#E0E0E0;"
                                                points="425.667,101.4 493.933,101.4 493.933,67.267 425.667,67.267 ">
                                            </polygon>
                                            <g>
                                                <path style="fill:#B6B6B6;"
                                                    d="M340.333,459.8H16.067c-5.12,0-8.533-3.413-8.533-8.533V7.533C7.533,2.413,10.947-1,16.067-1 h324.267c18.773,0,34.133,15.36,34.133,34.133v392.533C374.467,444.44,359.107,459.8,340.333,459.8z M24.6,442.733h315.733 c9.387,0,17.067-7.68,17.067-17.067V33.133c0-9.387-7.68-17.067-17.067-17.067H24.6V442.733z">
                                                </path>
                                                <path style="fill:#B6B6B6;"
                                                    d="M314.733,459.8h-42.667c-5.12,0-8.533-3.413-8.533-8.533V7.533c0-5.12,3.413-8.533,8.533-8.533 h42.667c5.12,0,8.533,3.413,8.533,8.533v443.733C323.267,456.387,319.853,459.8,314.733,459.8z M280.6,442.733h25.6V16.067h-25.6 V442.733z">
                                                </path>
                                                <path style="fill:#B6B6B6;"
                                                    d="M272.067,314.733h-256c-5.12,0-8.533-3.413-8.533-8.533V152.6c0-5.12,3.413-8.533,8.533-8.533h256 c5.12,0,8.533,3.413,8.533,8.533v153.6C280.6,311.32,277.187,314.733,272.067,314.733z M24.6,297.667h238.933V161.133H24.6 V297.667z">
                                                </path>
                                                <path style="fill:#B6B6B6;"
                                                    d="M365.933,314.733h-51.2c-5.12,0-8.533-3.413-8.533-8.533V152.6c0-5.12,3.413-8.533,8.533-8.533 h51.2c5.12,0,8.533,3.413,8.533,8.533v153.6C374.467,311.32,371.053,314.733,365.933,314.733z M323.267,297.667H357.4V161.133 h-34.133V297.667z">
                                                </path>
                                                <path style="fill:#B6B6B6;"
                                                    d="M101.4,502.467c-1.707,0-3.413-0.853-5.12-1.707L75.8,487.107L55.32,500.76 c-2.56,1.707-5.973,1.707-8.533,0c-3.413-0.853-5.12-3.413-5.12-6.827v-42.667c0-5.12,3.413-8.533,8.533-8.533h51.2 c5.12,0,8.533,3.413,8.533,8.533v42.667c0,3.413-1.707,5.973-4.267,7.68C103.96,502.467,103.107,502.467,101.4,502.467z M75.8,468.333c1.707,0,3.413,0.853,5.12,1.707l11.947,8.533V459.8H58.733v17.92l11.947-8.533 C72.387,469.187,74.093,468.333,75.8,468.333z">
                                                </path>
                                                <path style="fill:#B6B6B6;"
                                                    d="M459.8,493.933c-3.413,0-5.973-1.707-7.68-4.267l-34.133-59.733 c-0.853-1.707-0.853-2.56-0.853-4.267V24.6c0-13.653,11.093-25.6,25.6-25.6h34.133c13.653,0,25.6,11.093,25.6,25.6v401.067 c0,1.707,0,2.56-0.853,4.267l-34.133,59.733C465.773,492.227,463.213,493.933,459.8,493.933z M434.2,423.107l25.6,44.373 l25.6-44.373V24.6c0-4.267-3.413-8.533-8.533-8.533h-34.133c-4.267,0-8.533,3.413-8.533,8.533V423.107z M493.933,425.667 L493.933,425.667L493.933,425.667z">
                                                </path>
                                                <path style="fill:#B6B6B6;"
                                                    d="M493.933,109.933h-68.267c-5.12,0-8.533-3.413-8.533-8.533V67.267c0-5.12,3.413-8.533,8.533-8.533 h68.267c5.12,0,8.533,3.413,8.533,8.533V101.4C502.467,106.52,499.053,109.933,493.933,109.933z M434.2,92.867h51.2V75.8h-51.2 V92.867z">
                                                </path>
                                                <path style="fill:#B6B6B6;"
                                                    d="M493.933,434.2h-68.267c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533h68.267 c5.12,0,8.533,3.413,8.533,8.533S499.053,434.2,493.933,434.2z">
                                                </path>
                                                <path style="fill:#B6B6B6;"
                                                    d="M459.8,511c-5.12,0-8.533-3.413-8.533-8.533V485.4c0-5.12,3.413-8.533,8.533-8.533 s8.533,3.413,8.533,8.533v17.067C468.333,507.587,464.92,511,459.8,511z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </center>
                        </div>
                        {{-- <div class="md:col-span-1 bg-white rounded-lg p-4 shadow"> --}}
                            {{-- @include('components.kalender') --}}

                            {{-- </div> --}}
                        {{--
                    </div> --}}
                    <x-kalender />
                </div>

                {{-- Tugas --}}
                <div class="bg-white rounded-lg p-4 shadow">
                    <h2 class="text-lg font-semibold mb-2">Tugas</h2>
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