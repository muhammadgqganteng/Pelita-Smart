<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($ebook) ? 'Edit Ebook' : 'Tambah Ebook' }}
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ isset($ebook) ? route('guru.ebooks.update', $ebook) : route('guru.ebooks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($ebook))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label class="block text-gray-700">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $ebook->title ?? '') }}" class="w-full border rounded px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full border rounded px-4 py-2">{{ old('description', $ebook->description ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Cover</label>
                    <input type="file" name="cover_image" class="w-full border px-4 py-2">
                    @if(isset($ebook))
                        <p class="text-sm text-gray-500 mt-2">Cover saat ini:</p>
                        <img src="{{ asset('storage/'.$ebook->cover_image) }}" class="w-24 mt-2">
                    @endif
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">File PDF</label>
                    <input type="file" name="file" class="w-full border px-4 py-2">
                    @if(isset($ebook))
                        <p class="text-sm text-gray-500 mt-2">File saat ini: <a href="{{ asset('storage/'.$ebook->file) }}" target="_blank" class="text-blue-500 underline">Lihat</a></p>
                    @endif
                </div>

                <div>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">{{ isset($ebook) ? 'Update' : 'Simpan' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
