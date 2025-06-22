<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bab dari: {{ $ebook->title }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route($prefix . '.chapters.create', $ebook->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">+ Tambah Bab</a>

            <div class="space-y-4">
                @foreach ($ebook->chapters as $chapter)
                <div class="p-4 bg-white shadow rounded">
                    <h3 class="font-bold">{{ $chapter->title }}</h3>
                    <div class="text-sm text-gray-600 mt-1">{!! Str::limit(strip_tags($chapter->content), 100) !!}</div>
                    <div class="mt-2 space-x-2">
                        <a href="{{ route($prefix . '.chapters.edit', [$ebook->id, $chapter->id]) }}" class="text-yellow-600">Edit</a>
                        <form action="{{ route($prefix . '.chapters.destroy', [$ebook->id, $chapter->id]) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus bab ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
