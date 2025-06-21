
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold leading-tight text-gray-800">
            {{ isset($kelas) ? 'Edit Kelas: ' . $kelas->nama_kelas : 'Tambah Kelas Baru' }}
        </h2>
    </x-slot>

    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ isset($kelas) ? route('kelas.update', $kelas->id) : route('kelas.store') }}"
                          method="POST" x-data="{ successMessage: '{{ Session::get('success') }}', errorMessage: '{{ $errors->any() ? 'Ada kesalahan validasi.' : '' }}' }">
                        @csrf
                        @if(isset($kelas))
                            @method('PUT')
                        @endif

                        <div x-show="successMessage"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform -translate-y-4"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                             role="alert">
                            <span class="block sm:inline" x-text="successMessage"></span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="successMessage = ''">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.103l-2.651 2.646a1.2 1.2 0 1 1-1.697-1.697L8.303 9.407l-2.651-2.646a1.2 1.2 0 1 1 1.697-1.697L10 7.71l2.651-2.646a1.2 1.2 0 0 1 1.697 1.697L11.697 9.407l2.651 2.646a1.2 1.2 0 0 1 0 1.697z"/></svg>
                            </span>
                        </div>

                        <div x-show="errorMessage"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform -translate-y-4"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                             role="alert">
                            <span class="block sm:inline" x-text="errorMessage"></span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="errorMessage = ''">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.103l-2.651 2.646a1.2 1.2 0 1 1-1.697-1.697L8.303 9.407l-2.651-2.646a1.2 1.2 0 1 1 1.697-1.697L10 7.71l2.651-2.646a1.2 1.2 0 0 1 1.697 1.697L11.697 9.407l2.651 2.646a1.2 1.2 0 0 1 0 1.697z"/></svg>
                            </span>
                        </div>

                        {{-- Input untuk Nama Kelas --}}
                        <div class="mb-4">
                            <label for="nama_kelas" class="block text-gray-700 text-sm font-bold mb-2">Nama Kelas:</label>
                            <input type="text" name="nama_kelas" id="nama_kelas"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_kelas') border-red-500 @enderror"
                                   value="{{ old('nama_kelas', $kelas->nama_kelas ?? '') }}" required>
                            @error('nama_kelas')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input untuk Deskripsi --}}
                        <div class="mb-6">
                            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi (Opsional):</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $kelas->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                {{ isset($kelas) ? 'Perbarui Kelas' : 'Tambah Kelas' }}
                            </button>
                            <a href="{{ route('kelas.index') }}"
                               class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Kembali ke Daftar Kelas
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
   
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush