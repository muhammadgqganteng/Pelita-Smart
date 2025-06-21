

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                    <div x-data="{ successMessage: '{{ Session::get('success') }}' }"
                         x-show="successMessage"
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

                    <div class="mb-4 text-right">
                        <a href="{{ route('kelas.create') }}"
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                            Tambah Kelas Baru
                        </a>
                    </div>

                    @if($kelas->isEmpty())
                        <p class="text-gray-600 text-center py-8">Belum ada kelas yang ditambahkan.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                                <thead class="bg-gray-200 text-gray-700">
                                    <tr>
                                        <th class="py-3 px-4 text-left">No.</th>
                                        <th class="py-3 px-4 text-left">Nama Kelas</th>
                                        <th class="py-3 px-4 text-left">Deskripsi</th>
                                        <th class="py-3 px-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kelas as $index => $item)
                                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} border-b border-gray-200">
                                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                                            <td class="py-3 px-4">{{ $item->nama_kelas }}</td>
                                            <td class="py-3 px-4">{{ $item->deskripsi ?? '-' }}</td>
                                            <td class="py-3 px-4 text-center">
                                                <a href="{{ route('kelas.edit', $item->id) }}"
                                                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded-lg text-xs transition duration-150 ease-in-out mr-2">
                                                    Edit
                                                </a>
                                                <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="inline-block"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg text-xs transition duration-150 ease-in-out">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
 <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
@endpush