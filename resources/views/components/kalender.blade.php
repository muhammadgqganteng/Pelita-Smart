<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kalender Dinamis</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3f4f6;
      margin: 0;
      padding: 20px;
    }

    .kalender-container {
      max-width: 900px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .navigasi {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .grid-hari, .grid-tanggal {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      text-align: center;
      gap: 10px;
    }

    .grid-hari {
      font-weight: bold;
      margin-bottom: 10px;
    }

    .grid-tanggal div {
      padding: 10px 0;
      cursor: pointer;
      border-radius: 4px;
      transition: background-color 0.2s;
    }

    .grid-tanggal div:hover {
      background-color: #e0f2fe;
    }

    .tanggal-hari-ini {
      background-color: #3b82f6;
      color: white;
      font-weight: bold;
    }

    .agenda {
      border-top: 1px solid #ddd;
      margin-top: 20px;
      padding-top: 10px;
    }

    .agenda p {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .agenda ul {
      padding-left: 20px;
    }
  </style>
</head>
<body>

<div x-data="kalenderAgenda()" class="kalender-container">
  <!-- Navigasi -->
  <div class="navigasi">
    <button @click="mundur()">&#8592;</button>
    <span x-text="tanggalSekarang.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' })"></span>
    <button @click="maju()">&#8594;</button>
  </div>

  <!-- Hari-hari -->
  <div class="grid-hari">
    <template x-for="(hari, index) in hariMinggu" :key="index">
      <div x-text="hari"></div>
    </template>
  </div>

  <!-- Tanggal -->
  <div class="grid-tanggal">
    <template x-for="tanggal in tanggalBulanIni" :key="tanggal">
      <div
        x-text="tanggal"
        :class="{
          'tanggal-hari-ini': tanggal === hariIni.getDate() && tanggalSekarang.getMonth() === hariIni.getMonth()
        }">
      </div>
    </template>
  </div>

  <!-- Agenda -->
  <div class="agenda">
    <p>Agenda Hari Ini</p>
    <ul>
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

<script src="//unpkg.com/alpinejs" defer></script>
<script>
function kalenderAgenda() {
    const today = new Date();

    return {
        hariMinggu: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
        tanggalSekarang: new Date(),
        hariIni: today,
        agenda: {
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

</body>
</html>
