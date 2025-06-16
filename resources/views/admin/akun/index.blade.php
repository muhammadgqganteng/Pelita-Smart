    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Daftar Akun Pengguna
            </h2>
        </x-slot>

        <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-md">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">#</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Role</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Kelas</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
    
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition duration-200">
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $user->role }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $user->kelas->nama_kelas ?? '-' }}
                                </td>
                                {{-- @php
                                    dd($user->kelas->nama_kelas ?? '-');
                                @endphp --}}

                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('admin.akun.edit', $user) }}" class="inline-block text-blue-600 dark:text-blue-400 font-medium hover:underline transition">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
    </x-app-layout>
