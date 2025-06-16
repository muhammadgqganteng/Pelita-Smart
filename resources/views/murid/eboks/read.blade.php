<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $ebook->title }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <img src="{{ asset('storage/' . $ebook->cover_image) }}" alt="Cover" class="mb-4 w-full max-w-sm rounded shadow">
                <p class="text-gray-700 mb-4">{{ $ebook->description }}</p>

                <iframe src="{{ asset('storage/' . $ebook->file) }}" type="application/pdf" width="100%" height="600px"></iframe>
            </div>
        </div>
    </div>
</x-app-layout>
