<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($soal) ? 'Edit Soal' : 'Tambah Soal' }} - {{ $ujian->nama_ujian }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6">
        <form action="{{ isset($soal) ? route('guru.ujian.soal.store', [$ujian->id, $soal->id]) : route('guru.ujian.soal.store', $ujian->id) }}"
              method="POST" x-data="{ jenis: '{{ old('jenis_soal', $soal->jenis_soal ?? 'pg') }}', pilihanCounter: {{ isset($soal) ? count($soal->pilihanJawaban ?? []) : 2 }} }">
            @csrf
            @if(isset($soal))
                @method('PUT')
            @endif
z
            <div class="mb-4">
                <label for="jenis_soal" class="block text-sm font-medium text-gray-700">Jenis Soal</label>
                <select id="jenis_soal" name="jenis_soal" x-model="jenis"
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    <option value="pg">Pilihan Ganda</option>
                    <option value="esai">Esai</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Pertanyaan</label>
                <textarea id="pertanyaan" name="pertanyaan" rows="4"
                          class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                          required>{{ old('pertanyaan', $soal->pertanyaan ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="skor" class="block text-sm font-medium text-gray-700">Skor</label>
                <input type="number" name="skor" id="skor" min="0"
                       value="{{ old('skor', $soal->skor ?? 1) }}"
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
            </div>

            <!-- Pilihan Ganda -->
            <div x-show="jenis === 'pg'" class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Pilihan Jawaban</h3>
                <template x-for="(i, index) in Array.from({ length: pilihanCounter })" :key="index">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pilihan <span x-text="String.fromCharCode(65 + index)"></span></label>
                        <div class="flex items-center space-x-2 mt-1">
                            <input type="text" :name="`pilihan[]`" class="w-full rounded border-gray-300 shadow-sm" required>
                            <input type="radio" :value="index" name="jawaban_benar" class="form-radio text-blue-600">
                            <span class="text-sm text-gray-600">Benar</span>
                        </div>
                    </div>
                </template>
                <button type="button" @click="pilihanCounter++"
                        class="text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded">
                    + Tambah Pilihan
                </button>
            </div>

            <div class="flex space-x-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded shadow">
                    Simpan
                </button>
                <a href="{{ route('guru.ujian.soal.index', $ujian->id) }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded shadow">
                    Batal
                </a>
            </div>
        </form>
    </div>
<!-- </x-app-layout> --> -->
