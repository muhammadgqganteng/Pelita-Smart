<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Bab untuk Ebook: {{ $ebook->title }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('admin.ebooks.chapters.store', $ebook->id) }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="title" value="Judul Bab" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="content" value="Isi Bab" />
                <textarea id="content" name="content" rows="8" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <x-primary-button class="mt-2">
                Simpan Bab
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
