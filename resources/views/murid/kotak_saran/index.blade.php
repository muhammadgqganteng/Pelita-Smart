<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Saran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-semibold mb-4">{{ __('Daftar Saran yang Masuk') }}</h2>
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                        </div>
                    @endif
                    <ul class="space-y-4">
                        @forelse ($saran as $saran)
                            <li class="border rounded-md p-4">
                                <p class="font-semibold">{{ $saran->nama }} @if($saran->email) ({{ $saran->email }}) @endif</p>
                                <p class="text-gray-700">{{ $saran->isi_saran }}</p>
                                <div class="mt-2 text-sm text-gray-500">{{ $saran->created_at->diffForHumans() }}</div>
                                <form action="{{ route('murid.kotak-saran.destroy', $saran->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">{{ __('Hapus') }}</button>
                                </form>
                            </li>
                        @empty
                            <li>{{ __('Belum ada saran yang masuk.') }}</li>
                        @endforelse
                    </ul>
                    <div class="mt-4">
                        {{-- {{ $saran->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>