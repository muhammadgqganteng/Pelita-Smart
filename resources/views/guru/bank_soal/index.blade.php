<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Bank Soal</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-4">
        <a href="{{ route('guru.banksoal.create') }}"
           class="mb-4 inline-block bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
            + Tambah Soal
        </a>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Pertanyaan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Skor</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($soals as $soal)
                        <tr>
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ Str::limit($soal->pertanyaan, 60) }}</td>
                            <td class="px-4 py-2 uppercase">{{ $soal->jenis_soal }}</td>
                            <td class="px-4 py-2">{{ $soal->skor }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('guru.banksoal.edit', $soal->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('guru.banksoal.destroy', $soal->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-2 text-center text-gray-500">Belum ada soal</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
