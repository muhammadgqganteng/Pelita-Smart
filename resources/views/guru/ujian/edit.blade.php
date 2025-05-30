<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('update Ujian') }}
        </h2>
    </x-slot>

    <h1>Edit Ujian</h1>

    <form action="{{ route('guru.ujian.update', $ujian->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Ujian --}}
        <div class="mb-3">
            <label for="nama_ujian" class="form-label">Nama Ujian</label>
            <input type="text" id="nama_ujian" name="nama_ujian" class="form-control @error('nama_ujian') is-invalid @enderror" value="{{ old('nama_ujian', $ujian->nama_ujian) }}" required>
            @error('nama_ujian') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Mata Pelajaran --}}
        <div class="mb-3">
            <label for="mata_pelajaran_id" class="form-label">Mata Pelajaran</label>
            <select id="mata_pelajaran_id" name="mata_pelajaran_id" class="form-select @error('mata_pelajaran_id') is-invalid @enderror" required>
                <option value="">Pilih Mata Pelajaran</option>
                @foreach ($mataPelajaran as $mapel)
                    <option value="{{ $mapel->id }}" {{ old('mata_pelajaran_id', $ujian->mata_pelajaran_id) == $mapel->id ? 'selected' : '' }}>
                        {{ $mapel->nama_mapel }}
                    </option>
                @endforeach
            </select>
            @error('mata_pelajaran_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Kelas --}}
        <div class="mb-3">
            <label for="kelas_id" class="form-label">Kelas</label>
            <select id="kelas_id" name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" required>
                <option value="">Pilih Kelas</option>
                @foreach ($kelas as $kls)
                    <option value="{{ $kls->id }}" {{ old('kelas_id', $ujian->kelas_id) == $kls->id ? 'selected' : '' }}>
                        {{ $kls->nama_kelas }}
                    </option>
                @endforeach
            </select>
            @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $ujian->deskripsi) }}</textarea>
            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Tanggal Mulai --}}
        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai (Opsional)</label>
            <input type="datetime-local" id="tanggal_mulai" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                value="{{ old('tanggal_mulai', $ujian->tanggal_mulai ? \Carbon\Carbon::parse($ujian->tanggal_mulai)->format('Y-m-d\TH:i') : '') }}">
            @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Tanggal Selesai --}}
        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai (Opsional)</label>
            <input type="datetime-local" id="tanggal_selesai" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                value="{{ old('tanggal_selesai', $ujian->tanggal_selesai ? \Carbon\Carbon::parse($ujian->tanggal_selesai)->format('Y-m-d\TH:i') : '') }}">
            @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Waktu Ujian --}}
        <div class="mb-3">
            <label for="waktu_ujian" class="form-label">Waktu Ujian (Menit, Opsional)</label>
            <input type="number" id="waktu_ujian" name="waktu_ujian" class="form-control @error('waktu_ujian') is-invalid @enderror" value="{{ old('waktu_ujian', $ujian->waktu_ujian) }}">
            @error('waktu_ujian') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Jumlah Soal --}}
        <div class="mb-3">
            <label for="jumlah_soal" class="form-label">Jumlah Soal (Opsional)</label>
            <input type="number" id="jumlah_soal" name="jumlah_soal" class="form-control @error('jumlah_soal') is-invalid @enderror" value="{{ old('jumlah_soal', $ujian->jumlah_soal) }}">
            @error('jumlah_soal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Jenis Ujian --}}
        <div class="mb-3">
            <label for="jenis_ujian" class="form-label">Jenis Ujian</label>
            <select id="jenis_ujian" name="jenis_ujian" class="form-select @error('jenis_ujian') is-invalid @enderror" required>
                @foreach (['harian' => 'Harian', 'uts' => 'UTS', 'uas' => 'UAS', 'lainnya' => 'Lainnya'] as $value => $label)
                    <option value="{{ $value }}" {{ old('jenis_ujian', $ujian->jenis_ujian) == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('jenis_ujian') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                @foreach (['draft' => 'Draft', 'aktif' => 'Aktif', 'selesai' => 'Selesai', 'arsipkan' => 'Arsipkan'] as $value => $label)
                    <option value="{{ $value }}" {{ old('status', $ujian->status) == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Acak Soal --}}
        <div class="mb-3 form-check">
            <input type="checkbox" id="acak_soal" name="acak_soal" class="form-check-input @error('acak_soal') is-invalid @enderror" {{ old('acak_soal', $ujian->acak_soal) ? 'checked' : '' }}>
            <label for="acak_soal" class="form-check-label">Acak Soal</label>
            @error('acak_soal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Acak Jawaban --}}
        <div class="mb-3 form-check">
            <input type="checkbox" id="acak_jawaban" name="acak_jawaban" class="form-check-input @error('acak_jawaban') is-invalid @enderror" {{ old('acak_jawaban', $ujian->acak_jawaban) ? 'checked' : '' }}>
            <label for="acak_jawaban" class="form-check-label">Acak Jawaban (PG)</label>
            @error('acak_jawaban') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Nilai Lulus --}}
        <div class="mb-3">
            <label for="nilai_lulus" class="form-label">Nilai Lulus (Opsional)</label>
            <input type="number" id="nilai_lulus" name="nilai_lulus" class="form-control @error('nilai_lulus') is-invalid @enderror" value="{{ old('nilai_lulus', $ujian->nilai_lulus) }}">
            @error('nilai_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Instruksi Khusus --}}
        <div class="mb-3">
            <label for="instruksi_khusus" class="form-label">Instruksi Khusus (Opsional)</label>
            <textarea id="instruksi_khusus" name="instruksi_khusus" class="form-control @error('instruksi_khusus') is-invalid @enderror">{{ old('instruksi_khusus', $ujian->instruksi_khusus) }}</textarea>
            @error('instruksi_khusus') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('guru.ujian.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</x-app-layout>