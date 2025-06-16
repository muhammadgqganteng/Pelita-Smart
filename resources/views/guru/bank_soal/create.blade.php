<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ isset($soal) ? 'Edit Soal' : 'Tambah Soal' }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ isset($soal) ? route('guru.banksoal.update', $soal->id) : route('guru.banksoal.store') }}"
              x-data="soalForm()" x-init="init">
            @csrf
            @if (isset($soal))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block font-medium">Jenis Soal</label>
                <select name="jenis_soal" x-model="jenis" class="w-full rounded border-gray-300 shadow-sm">
                    <option value="pg">Pilihan Ganda</option>
                    <option value="esai">Esai</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Pertanyaan</label>
                <textarea name="pertanyaan" class="w-full rounded border-gray-300 shadow-sm" required>{{ old('pertanyaan', $soal->pertanyaan ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Skor</label>
                <input type="number" name="skor" min="0" class="w-full rounded border-gray-300 shadow-sm"
                       value="{{ old('skor', $soal->skor ?? 1) }}" required>
            </div>

            {{-- PILIHAN GANDA --}}
            <div class="mb-4" x-show="jenis === 'pg'">
                <label class="block font-medium mb-2">Pilihan Jawaban</label>
                <template x-for="(i, index) in Array.from({ length: pilihanCounter })" :key="index">
                    <div class="flex items-center gap-2 mb-2">
                        <input type="text"
                               class="w-full border rounded px-2 py-1"
                               :name="`pilihan[${index}]`"
                               x-model="pilihanInputs[index]"
                               :required="jenis === 'pg'"
                               :disabled="jenis !== 'pg'">
                        <input type="radio"
                               name="jawaban_benar"
                               :value="index"
                               x-model="jawabanBenar"
                               :disabled="jenis !== 'pg'">
                        <span class="text-sm text-gray-600">Benar</span>
                    </div>
                </template>
                <button type="button" @click="addPilihan()" class="text-sm bg-gray-200 px-2 py-1 rounded">
                    + Tambah Pilihan
                </button>
            </div>

            <div class="mt-4 flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>
                <a href="{{ route('guru.banksoal.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('soalForm', () => ({
                jenis: '{{ old('jenis_soal', $soal->jenis_soal ?? 'pg') }}',
                pilihanCounter: {{ isset($soal) ? count($soal->pilihanJawaban ?? []) : 2 }},
                pilihanInputs: {},
                jawabanBenar: '{{ old('jawaban_benar', '') }}',

                init() {
                    @if(isset($soal) && $soal->jenis_soal === 'pg')
                        @foreach($soal->pilihanJawaban as $key => $pilihan)
                            this.pilihanInputs[{{ $key }}] = @json($pilihan->jawaban);
                            @if($pilihan->benar)
                                this.jawabanBenar = '{{ $key }}';
                            @endif
                        @endforeach
                    @else
                        for (let i = 0; i < this.pilihanCounter; i++) {
                            this.pilihanInputs[i] = '';
                        }
                    @endif
                },

                addPilihan() {
                    this.pilihanInputs[this.pilihanCounter] = '';
                    this.pilihanCounter++;
                }
            }));
        });
    </script>
</x-app-layout>
