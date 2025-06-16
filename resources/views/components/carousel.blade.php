<div x-data="{
    current: 0,
    slides: [
        { title: 'Selamat Datang di Bank Soal!', desc: 'Kelola soal dengan mudah dan efisien.', color: 'bg-blue-100' },
        { title: 'Fitur Baru!', desc: 'Kini Anda bisa import soal dari Excel.', color: 'bg-green-100' },
        { title: 'Statistik Soal', desc: 'Lihat ringkasan soal berdasarkan mapel.', color: 'bg-yellow-100' }
    ],
    next() { this.current = (this.current + 1) % this.slides.length },
    prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length },
    init() {
        setInterval(() => this.next(), 5000);
    }
}" x-init="init()" class="w-full ">
    <div class="relative overflow-hidden rounded-xl shadow-md" :class="slides[current].color">
        <!-- Konten Slide -->
        <div class="px-6 py-4 transition-all duration-500">
            <h2 class="text-lg font-bold text-gray-800" x-text="slides[current].title"></h2>
            <p class="text-sm text-gray-600" x-text="slides[current].desc"></p>
        </div>

        <!-- Tombol Navigasi -->
        <button @click="prev" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white rounded-full p-2 shadow hover:bg-gray-100">
            ◀
        </button>
        <button @click="next" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white rounded-full p-2 shadow hover:bg-gray-100">
            ▶
        </button>
    </div>
</div>
