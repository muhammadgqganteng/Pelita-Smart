<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold">{{ $tugas->judul }}</h2>
    </x-slot>

    <div class="p-4">
        <form action="{{ route('murid.tugas.submit', $tugas->id) }}" method="POST">
            @csrf

            @foreach ($tugas->soal as $index => $soal)
                <div class="mb-6">
                    <p class="font-semibold">{{ $index + 1 }}. {!! $soal->pertanyaan !!}</p>

                    @if ($soal->jenis_soal === 'pg')
                        @foreach ($soal->pilihanJawaban as $pilihan)
                            <label class="block ml-4">
                                <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $pilihan->id }}" class="mr-2">
                                {{ $pilihan->jawaban }}
                            </label>
                        @endforeach

                    @elseif ($soal->jenis_soal === 'esai' || $soal->jenis_soal === 'isian')
                        <textarea name="jawaban[{{ $soal->id }}]" rows="3" class="w-full mt-2 border rounded"></textarea>

                    @elseif ($soal->jenis_soal === 'menjodohkan')
                        <input type="text" name="jawaban[{{ $soal->id }}]" class="w-full mt-2 border rounded" placeholder="Contoh: A=1, B=2">
                    @endif
                </div>
            @endforeach

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Kumpulkan</button>
        </form>
    </div>
</x-app-layout>
    