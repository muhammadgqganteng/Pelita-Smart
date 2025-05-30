<x-app-layout>
    <x-slot name="header">Tambah Bank Soal</x-slot>

    <form method="POST" action="{{ route('guru.bank-soal.store') }}" x-data="soalForm()" class="max-w-2xl mx-auto p-4">
        @csrf

        <div class="mb-4">
            <label>Jenis Soal</label>
            <select name="jenis_soal" x-model="jenis" class="w-full mt-1">
                <option value="pg">Pilihan Ganda</option>
                <option value="esai">Esai</option>
            </select>
        </div>

        <div class="mb-4">
            <label>Pertanyaan</label>
            <textarea name="pertanyaan" required class="w-full mt-1"></textarea>
        </div>

        <div class="mb-4">
            <label>Skor</label>
            <input type="number" name="skor" min="1" value="1" class="w-full mt-1" />
        </div>

        <div x-show="jenis === 'pg'" class="mb-6">
            <template x-for="(i, index) in Array.from({ length: pilihanCounter })" :key="index">
                <div class="mb-2">
                    <input type="text" :name="`pilihan[${index}]`" class="w-full" required />
                    <label><input type="radio" :value="index" name="jawaban_benar" x-model="jawabanBenar" /> Benar</label>
                </div>
            </template>
            <button type="button" @click="addPilihan()" class="bg-gray-300 px-2 py-1">+ Tambah Pilihan</button>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('soalForm', () => ({
                jenis: 'pg',
                pilihanCounter: 2,
                jawabanBenar: '',
                addPilihan() {
                    this.pilihanCounter++
                }
            }))
        })
    </script>
</x-app-layout>
