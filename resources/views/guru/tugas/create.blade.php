<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">
        <h2 class="text-xl font-bold mb-4">Buat Tugas Baru</h2>
        <form action="{{ route('guru.tugas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Judul Tugas</label>
                <input type="text" name="judul" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Deadline</label>
                <input type="datetime-local" name="tanggal_deadline" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Pilih Soal dari Bank Soal</label>
                <div class="max-h-48 overflow-y-auto border rounded p-2">
                    @forelse($bankSoal as $soal)
                        <label class="flex items-start gap-2 mb-2">
                            <input type="checkbox" name="bank_soal_ids[]" value="{{ $soal->id }}">
                            <span>{{ $soal->pertanyaan }} ({{ $soal->jenis_soal }})</span>
                        </label>
                    @empty
                        <p class="text-gray-500 text-sm">Tidak ada soal di Bank Soal.</p>
                    @endforelse
                </div>
            </div>

            <div class="text-right">
                <button class="bg-blue-600 text-white px-4 py-2 rounded" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan validasi atau interaksi JavaScript jika diperlukan
        });
    </script>