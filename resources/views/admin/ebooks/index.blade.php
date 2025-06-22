<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Ebook') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route( 'admin.ebooks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Ebook</a>

            <div class="mt-4 bg-white shadow rounded p-4">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="text-left px-4 py-2">Judul</th>
                            <th class="text-left px-4 py-2">Cover</th>
                            <th class="text-left px-4 py-2">File</th>
                            <th class="text-left px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ebooks as $ebook)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $ebook->title }}</td>
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/' . $ebook->cover_image) }}" alt="cover" class="h-16">
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ asset('storage/' . $ebook->file) }}" type="application/pdf" class="text-blue-600 underline">Lihat</a>
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route( 'admin.ebooks.edit', $ebook->id) }}" class="text-yellow-600">Edit</a>
                                <form action="{{ route( 'admin.ebooks.destroy', $ebook->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600">Hapus</button>
                                </form>
                                <a href="{{ route( 'admin.ebooks.chapters.index', $ebook->id) }}" class="text-green-600">Bab</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
