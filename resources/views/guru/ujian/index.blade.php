<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ujian') }}
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        {{-- Judul dan tombol tambah --}}
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold text-gray-700">Daftar Ujian</h1>
            <a href="{{ route('guru.ujian.create') }}" class="bg-blue-600 text-greey px-4 py-2 rounded hover:bg-blue-700">+ Tambah Ujian</a>
        </div>

        {{-- Alert sukses --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabel daftar ujian --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-blue-100 text-gray-700 font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Nama Ujian</th>
                        <th class="px-4 py-3 text-left">Mata Pelajaran</th>
                        <th class="px-4 py-3 text-left">Kelas</th>
                        <th class="px-4 py-3 text-left">Tanggal Mulai</th>
                        <th class="px-4 py-3 text-left">Tanggal Selesai</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($ujians as $ujian)
                        <tr>
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $ujian->nama_ujian }}</td>
                            <td class="px-4 py-2">{{ $ujian->mataPelajaran->nama_mapel ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $ujian->kelas->nama_kelas ?? '-' }}</td>
                            <td class="px-4 py-2">
                                {{ $ujian->tanggal_mulai ? \Carbon\Carbon::parse($ujian->tanggal_mulai)->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $ujian->tanggal_selesai ? \Carbon\Carbon::parse($ujian->tanggal_selesai)->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                <span class="
                                    px-2 py-1 text-xs rounded font-medium
                                    {{ $ujian->status == 'aktif' ? 'bg-green-200 text-green-800' :
                                        ($ujian->status == 'draft' ? 'bg-yellow-200 text-yellow-800' : 'bg-gray-200 text-gray-800') }}
                                ">
                                    {{ ucfirst($ujian->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 space-x-1">
                                <a href="{{ route('guru.ujian.show', $ujian->id) }}" class="bg-blue-500 text-greey px-3 py-1 rounded hover:bg-blue-600 text-xs">Lihat</a>
                                <a href="{{ route('guru.ujian.edit', $ujian->id) }}" class="bg-yellow-400 text-greey px-3 py-1 rounded hover:bg-yellow-500 text-xs">Edit</a>
                                <form action="{{ route('guru.ujian.destroy', $ujian->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ujian ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-greey px-3 py-1 rounded hover:bg-red-600 text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">Tidak ada ujian yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $ujians->links() }}
        </div>
    </div>
</x-app-layout>
