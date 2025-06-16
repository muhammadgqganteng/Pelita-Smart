<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit Akun: {{ $user->name }}</h2>
    </x-slot>

    <div class="p-4 max-w-lg mx-auto bg-white shadow-md rounded">
        <form method="POST" action="{{ route('admin.akun.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-bold">Role</label>
                <select name="role" class="w-full mt-1 border rounded p-2">
                    <option value="murid" @selected($user->role == 'murid')>Murid</option>
                    <option value="guru" @selected($user->role == 'guru')>Guru</option>
                    <option value="admin" @selected($user->role == 'admin')>Admin</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Kelas</label>
                <select name="kelas_id" class="w-full mt-1 border rounded p-2">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" @selected($user->kelas_id == $k->id)>{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </form>
    </div>
</x-app-layout>
