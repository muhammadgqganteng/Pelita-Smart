<x-app-layout>
    <h2 class="text-xl font-semibold">Tugas: {{ $tugas->judul }}</h2>
{{-- <pre>{{ dd($tugas) }}</pre> --}}
@if(!$tugas || !$tugas->id)
    <p class="text-red-500">⚠ Tugas tidak valid / tidak ditemukan.</p>
@endif

    
<form method="POST" action="{{ route('guru.tugas.importSoal', ['tugas' => $tugas->id]) }}">

        @csrf
        <h3 class="text-lg font-medium mt-4">Import Soal dari Bank Soal</h3>
        @foreach($bankSoals as $soal)
            <label class="block">
                <input type="checkbox" name="bank_soal_ids[]" value="{{ $soal->id }}">
                {{ $soal->pertanyaan }}
            </label>
        @endforeach
        <button type="submit" class="mt-2 bg-green-500 px-4 py-2 text-white rounded">Import</button>
    </form>
</x-app-layout>
