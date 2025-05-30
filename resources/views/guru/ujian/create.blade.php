<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ujian') }}
        </h2>
    </x-slot>
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Ujian Baru</h1>

    <form action="{{ route('guru.ujian.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Nama Ujian --}}
        <div>
            <label for="nama_ujian" class="block text-sm font-medium text-gray-700">Nama Ujian</label>
            <input type="text" id="nama_ujian" name="nama_ujian" value="{{ old('nama_ujian') }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('nama_ujian') border-red-500 @enderror" required>
            @error('nama_ujian') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Mata Pelajaran --}}
        <div>
            <label for="mata_pelajaran_id" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
            <select id="mata_pelajaran_id" name="mata_pelajaran_id" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('mata_pelajaran_id') border-red-500 @enderror">
                <option value="">Pilih Mata Pelajaran</option>
                @foreach ($mataPelajaran as $mapel)
                    <option value="{{ $mapel->id }}" {{ old('mata_pelajaran_id') == $mapel->id ? 'selected' : '' }}>
                        {{ $mapel->nama_mapel }}
                    </option>
                @endforeach
            </select>
            @error('mata_pelajaran_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Kelas --}}
        <div>
            <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
            <select id="kelas_id" name="kelas_id" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('kelas_id') border-red-500 @enderror">
                <option value="">Pilih Kelas</option>
                @foreach ($kelas as $kls)
                    <option value="{{ $kls->id }}" {{ old('kelas_id') == $kls->id ? 'selected' : '' }}>{{ $kls->nama_kelas }}</option>
                @endforeach
            </select>
            @error('kelas_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Deskripsi --}}
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tanggal --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="datetime-local" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tanggal_mulai') border-red-500 @enderror">
                @error('tanggal_mulai') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="datetime-local" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tanggal_selesai') border-red-500 @enderror">
                @error('tanggal_selesai') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Waktu dan jumlah soal --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="waktu_ujian" class="block text-sm font-medium text-gray-700">Waktu Ujian (Menit)</label>
                <input type="number" id="waktu_ujian" name="waktu_ujian" value="{{ old('waktu_ujian') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('waktu_ujian') border-red-500 @enderror">
                @error('waktu_ujian') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="jumlah_soal" class="block text-sm font-medium text-gray-700">Jumlah Soal</label>
                <input type="number" id="jumlah_soal" name="jumlah_soal" value="{{ old('jumlah_soal') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jumlah_soal') border-red-500 @enderror">
                @error('jumlah_soal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Jenis dan status --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="jenis_ujian" class="block text-sm font-medium text-gray-700">Jenis Ujian</label>
                <select id="jenis_ujian" name="jenis_ujian" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jenis_ujian') border-red-500 @enderror">
                    <option value="harian" {{ old('jenis_ujian') == 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="uts" {{ old('jenis_ujian') == 'uts' ? 'selected' : '' }}>UTS</option>
                    <option value="uas" {{ old('jenis_ujian') == 'uas' ? 'selected' : '' }}>UAS</option>
                    <option value="lainnya" {{ old('jenis_ujian') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('jenis_ujian') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="arsipkan" {{ old('status') == 'arsipkan' ? 'selected' : '' }}>Arsipkan</option>
                </select>
                @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Checkbox --}}
        <div class="flex items-center space-x-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="acak_soal" id="acak_soal" class="rounded text-blue-600 border-gray-300 focus:ring-blue-500" {{ old('acak_soal') ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-700">Acak Soal</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="acak_jawaban" id="acak_jawaban" class="rounded text-blue-600 border-gray-300 focus:ring-blue-500" {{ old('acak_jawaban') ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-700">Acak Jawaban (PG)</span>
            </label>
        </div>

        {{-- Nilai dan instruksi --}}
        <div>
            <label for="nilai_lulus" class="block text-sm font-medium text-gray-700">Nilai Lulus</label>
            <input type="number" id="nilai_lulus" name="nilai_lulus" value="{{ old('nilai_lulus') }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('nilai_lulus') border-red-500 @enderror">
            @error('nilai_lulus') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="instruksi_khusus" class="block text-sm font-medium text-gray-700">Instruksi Khusus</label>
            <textarea id="instruksi_khusus" name="instruksi_khusus"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('instruksi_khusus') border-red-500 @enderror">{{ old('instruksi_khusus') }}</textarea>
            @error('instruksi_khusus') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-2 pt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('guru.ujian.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>

</x-app-layout>