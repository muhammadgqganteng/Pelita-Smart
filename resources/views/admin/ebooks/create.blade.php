<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($ebook) ? 'Edit Ebook' : 'Tambah Ebook' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded p-6">
            <form action="{{ isset($ebook) ? route('admin.ebooks.update', $ebook->id) : route( 'admin.ebooks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($ebook)) @method('PUT') @endif

                <div class="mb-4">
                    <label class="block font-medium mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $ebook->title ?? '') }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Deskripsi</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $ebook->description ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Cover</label>
                    <input type="file" name="cover_image">
                    @if(isset($ebook))
                        <img src="{{ asset('storage/' . $ebook->cover_image) }}" class="h-24 mt-2">
                    @endif
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">File PDF</label>
                    <input type="file" name="file">
                    @if(isset($ebook))
                        <a href="{{ asset('storage/' . $ebook->file) }}" target="_blank" class="text-blue-600 underline mt-2 inline-block">Lihat File</a>
                    @endif
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    {{ isset($ebook) ? 'Update' : 'Simpan' }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
