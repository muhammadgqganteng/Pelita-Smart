<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Dinamis</title>
    <link rel="stylesheet" href="resource/css/style.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

<div x-data="kalenderAgenda()" class="p-3 bg-white rounded-lg shadow w-64 text-gray-800 text-xs">
<div x-data="kalenderAgenda()" class="p-3 bg-white rounded-lg shadow w-[300px] text-gray-800 text-xs">
  <!-- Navigasi bulan -->
  <div class="flex justify-between items-center mb-3">
    <button @click="mundur()" class="px-2 py-1 rounded hover:bg-gray-100">&lt;</button>
    <span class="font-semibold text-sm text-center w-full" x-text="tanggalSekarang.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' })"></span>
    <button @click="maju()" class="px-2 py-1 rounded hover:bg-gray-100">&gt;</button>
  </div>

  <!-- Hari-hari (horizontal) -->
  <div class="grid grid-cols-7 gap-1 text-center font-semibold text-gray-600 mb-1">
    <template x-for="(hari, index) in hariMinggu" :key="index">
      <div x-text="hari" class="py-1"></div>
    </template>
  </div>

  <!-- Tanggal -->
  <div class="grid grid-cols-7 gap-1 text-center">
    <template x-for="tanggal in tanggalBulanIni" :key="tanggal">
      <div 
        :class="{
          'bg-blue-500 text-white font-bold rounded-md': tanggal === hariIni.getDate() && tanggalSekarang.getMonth() === hariIni.getMonth() && tanggalSekarang.getFullYear() === hariIni.getFullYear(),
          'hover:bg-blue-100 rounded-md': true
        }"
        class="py-1 cursor-pointer transition"
        x-text="tanggal">
      </div>
    </template>
  </div>

  <!-- Agenda Hari Ini -->
  <div class="mt-3 border-t pt-2">
    <p class="font-bold text-sm mb-1">Agenda Hari Ini</p>
    <ul class="list-disc list-inside space-y-0.5">
      <template x-if="agendaHariIni.length > 0">
        <template x-for="item in agendaHariIni" :key="item">
          <li x-text="item"></li>
        </template>
      </template>
      <template x-if="agendaHariIni.length === 0">
        <li>Tidak ada agenda</li>
      </template>
    </ul>
  </div>
</div>



    

    {{-- <script src="script.js"></script> --}}
    
    <script src={{ asset('js/app.js') }}></script>

</body>
</html>
<script>
function kalenderAgenda() {
    const today = new Date();

    return {
        hariMinggu: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
        tanggalSekarang: new Date(),
        hariIni: today,
        agenda: {
            // Format: 'YYYY-MM-DD': [agenda1, agenda2, ...]
            '2025-05-24': ['Ujian Matematika', 'Review Tugas RPL'],
            '2025-05-25': ['Libur Nasional']
        },

        get tanggalBulanIni() {
            const tanggal = [];
            const year = this.tanggalSekarang.getFullYear();
            const month = this.tanggalSekarang.getMonth();
            const days = new Date(year, month + 1, 0).getDate();

            for (let i = 1; i <= days; i++) {
                tanggal.push(i);
            }

            return tanggal;
        },

        get agendaHariIni() {
            const key = this.tanggalSekarang.toISOString().split('T')[0];
            return this.agenda[key] || [];
        },

        mundur() {
            this.tanggalSekarang.setMonth(this.tanggalSekarang.getMonth() - 1);
            this.tanggalSekarang = new Date(this.tanggalSekarang);
        },

        maju() {
            this.tanggalSekarang.setMonth(this.tanggalSekarang.getMonth() + 1);
            this.tanggalSekarang = new Date(this.tanggalSekarang);
        }
    }
}
</script>
<script src="//unpkg.com/alpinejs" defer></script>

<script src="resource/js/script.js"></script>
