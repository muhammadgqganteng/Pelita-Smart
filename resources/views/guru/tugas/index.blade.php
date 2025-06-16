<x-app-layout>
    <div class="max-w-6xl mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold">Daftar Tugas</h1>
            <a href="{{ route('guru.tugas.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Buat Tugas</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded p-4">
            @if ($tugas->count())
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="border px-4 py-2">Judul</th>
                            <th class="border px-4 py-2">Deadline</th>
                            <th class="border px-4 py-2">Jumlah Soal</th>
                            <th class="border px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas as $t)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $t->judul }}</td>
                                <td class="border px-4 py-2">
                                    {{ $t->tanggal_deadline ? \Carbon\Carbon::parse($t->tanggal_deadline)->format('d M Y H:i') : '-' }}
                                </td>
                                <td class="border px-4 py-2">{{ $t->soal->count() }} soal</td>
                                <td class="border px-4 py-2 text-center space-x-1">
                                    <a href="{{ route('guru.tugas.show', $t->id) }}"
                                       class="text-blue-600 hover:underline">Lihat</a>
                                    <a href="{{ route('guru.tugas.edit', $t->id) }}"
                                       class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('guru.tugas.destroy', $t->id) }}" method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                    {{-- Tombol Import Soal jika ingin ubah atau tambah --}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Belum ada tugas dibuat.</p>
            @endif
        </div>
    </div>
</x-app-layout>
