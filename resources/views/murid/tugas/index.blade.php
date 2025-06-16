<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold">Daftar Tugas</h2>
    </x-slot>

    <div class="p-4">
        <div class="bg-white p-4 rounded shadow">
            @foreach ($tugasList as $tugas)
                <div class="mb-4">
                    <h3 class="font-bold text-lg">{{ $tugas->judul }}</h3>
                    <p class="text-sm text-gray-600">{{ $tugas->deskripsi }}</p>
                    <p class="text-xs text-gray-500">Deadline: {{ $tugas->tanggal_deadline }}</p>
                    <a href="{{ route('murid.tugas.show', $tugas->id) }}" class="mt-2 inline-block text-blue-500 underline">Kerjakan</a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
