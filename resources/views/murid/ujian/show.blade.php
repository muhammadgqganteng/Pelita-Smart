<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $ujian->nama_ujian }}
        </h2>
    </x-slot>

    <div class="p-6" x-data="ujianApp()">
        <div class="mb-4">
            <p class="text-gray-600">Mata Pelajaran:
                <span class="font-medium">{{ $ujian->mataPelajaran->nama_mapel ?? '-' }}</span>
            </p>
        </div>

        {{-- Navigasi Soal --}}
        <div class="flex flex-wrap gap-2 justify-center mb-6">
            <template x-for="(item, idx) in soalList" :key="item.id">
                <button type="button"
                    class="w-10 h-10 rounded-full border font-bold"
                    :class="currentIndex === idx ? 'bg-indigo-600 text-white' : 'bg-white text-indigo-600 border-indigo-600'"
                    @click="currentIndex = idx">
                    <span x-text="idx + 1"></span>
                </button>
            </template>
        </div>

        <form action="{{ route('murid.ujian.submit', $ujian->id) }}" method="POST">
            @csrf

            <div class="space-y-6">
                @foreach ($soal as $index => $item)
                    <div x-show="currentIndex === {{ $index }}" class="bg-white p-6 rounded-lg shadow">
                        <div class="mb-2 flex justify-between items-center">
                            <span class="text-lg font-semibold">Soal {{ $index + 1 }}</span>
                            <span class="text-sm text-gray-500">({{ ucfirst($item->jenis_soal) }})</span>
                        </div>
                        <p class="mb-4 text-gray-800">{{ $item->pertanyaan }}</p>

                        @if ($item->jenis_soal === 'pg')
                            <div class="space-y-2">
                                @foreach ($item->pilihanJawaban->shuffle() as $pilihan)
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="jawaban[{{ $item->id }}]" value="{{ $pilihan->id }}"
                                            x-model="jawabanSiswa[{{ $item->id }}]"
                                            @change="simpanPilihanOtomatis('{{ $item->id }}', $event.target.value)"
                                            class="form-radio text-indigo-600">
                                        <span>{{ $pilihan->jawaban }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @elseif ($item->jenis_soal === 'esai')
                            <textarea name="jawaban[{{ $item->id }}]" rows="4"
                                    x-model="jawabanSiswa[{{ $item->id }}]"
                                    @input="simpanJawabanOtomatis('{{ $item->id }}', $event)"
                                    class="w-full mt-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Tuliskan jawaban Anda di sini..."></textarea>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-between items-center">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow md:gap-10">
                    Kumpulkan Jawaban
                </button>
                <span class="text-sm text-gray-500 sm:gap-4">Total Soal: {{ count($soal) }}</span>
            </div>
        </form>
    </div>

    {{-- Alpine JS --}}
<script>
        function ujianApp() {
            return {
                currentIndex: 0,
                soalList: @json($soal->map(fn($s) =>  ['id' => $s->id])),
                jawabanSiswa: {}, // Untuk menyimpan jawaban murid  
                ujianId: '{{ $ujian->id }}',

                init() {
                    this.soalList.forEach(soal => {
                        const storedAnswer = localStorage.getItem(`ujian_${this.ujianId}_soal_${soal.id}`);
                        if (storedAnswer) {
                            this.jawabanSiswa[soal.id] = storedAnswer;
                            // Set nilai input berdasarkan jawaban yang disimpan
                            this.$nextTick(() => {
                                const input = this.$root.querySelector(`[name="jawaban[${soal.id}]"][value="${storedAnswer}"]`);
                                if (input) {
                                    input.checked = true;
                                }
                                const textarea = this.$root.querySelector(`[name="jawaban[${soal.id}]"]`);
                                if (textarea && textarea.tagName === 'TEXTAREA') {
                                    textarea.value = storedAnswer;
                                }
                            });
                        } else {
                            this.jawabanSiswa[soal.id] = ''; // jika belum ada jawaban
                        }
                    });
                },

                updateJawaban(soalId, jawaban) {
                    this.jawabanSiswa[soalId] = jawaban;
                    localStorage.setItem(`ujian_${this.ujianId}_soal_${soalId}`, jawaban);
                },

                simpanJawabanOtomatis(soalId, event) {
                    this.updateJawaban(soalId, event.target.value);
                },

                simpanPilihanOtomatis(soalId, value) {
                    this.updateJawaban(soalId, value);
                },
            }
        }
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
