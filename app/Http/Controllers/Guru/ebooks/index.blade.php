<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Ebook
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <a href="{{ route('guru.ebooks.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Tambah Ebook</a>

        <div class="mt-6 bg-white shadow-md rounded-lg p-4">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Judul</th>
                        <th class="px-4 py-2 border">Cover</th>
                        <th class="px-4 py-2 border">File</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ebooks as $ebook)
                        <tr>
                            <td class="border px-4 py-2">{{ $ebook->title }}</td>
                            <td class="border px-4 py-2">
                                <img src="{{ asset('storage/'.$ebook->cover_image) }}" class="w-16 h-20 object-cover">
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ asset('storage/'.$ebook->file) }}" target="_blank" class="text-blue-500 underline">Lihat File</a>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('guru.ebooks.edit', $ebook) }}" class="text-yellow-500 mr-2">Edit</a>
                                <a href="{{ route('guru.ebooks.chapters.index', $ebook) }}" class="text-indigo-500 mr-2">Bab</a>
                                <form action="{{ route('guru.ebooks.destroy', $ebook) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus ebook ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($ebooks->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada ebook</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
