<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Tugas</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <form action="{{ route('guru.tugas.update', $tugas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $tugas->judul) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border rounded px-3 py-2">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Deadline</label>
                <input type="datetime-local" name="tanggal_deadline" value="{{ old('tanggal_deadline', \Carbon\Carbon::parse($tugas->tanggal_deadline)->format('Y-m-d\TH:i')) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
