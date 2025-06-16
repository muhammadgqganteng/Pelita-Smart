<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Soal Ujian: {{ $ujian->nama_ujian }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
      
        
        <!-- Modal -->
        
        
        
        <div class="flex justify-between mb-4" >
            <a href="{{ route('guru.ujian.soal.create', $ujian->id) }}"
                class="bg-blue-600 hover:bg-blue-700 text-greey py-2 px-4 rounded ">
                + Tambah Soal
            </a>
            <div x-data="{ open: false }">
                <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded">Import dari Bank Soal</button>
            
                
                <div x-show="open" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded shadow w-1/2 relative">
                        <h2 class="text-xl font-bold mb-4">Pilih Soal dari Bank Soal</h2>
                        <form method="POST" action="{{ route('guru.ujian.soal.import', $ujian->id) }}">
                            @csrf
                            <div class="grid gap-2 max-h-64 overflow-y-auto">
                                @foreach($bankSoal as $soal)
                                    <label class="flex items-start gap-2">
                                        <input type="checkbox" name="bank_soal_ids[]" value="{{ $soal->id }}" class="mt-1">
                                        <div>
                                            <div class="font-semibold">{{ $soal->pertanyaan }}</div>
                                            <div class="text-sm text-gray-500">Jenis: {{ strtoupper($soal->jenis_soal) }} | Skor: {{ $soal->skor }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Import</button>
                            </div>
                        </form>
                        <button @click="open = false" class="absolute top-2 right-2 text-gray-600 text-2xl ">&times;</button>
                    </div>
                </div>
            </div>
            <a href="{{ route('guru.ujian.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                Kembali
            </a>
        </div>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Pertanyaan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Jenis</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Skor</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($list_soal as $soal)
                        <tr>
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ Str::limit($soal->pertanyaan, 50) }}</td>
                            <td class="px-4 py-2 capitalize">{{ $soal->jenis_soal }}</td>
                            <td class="px-4 py-2">{{ $soal->skor }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('guru.ujian.soal.edit', [$ujian->id, $soal->id]) }}"
                                    class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('guru.ujian.soal.destroy', [$ujian->id, $soal->id]) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">Belum ada soal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $list_soal->links() }}
        </div>
    </div>
</x-app-layout>