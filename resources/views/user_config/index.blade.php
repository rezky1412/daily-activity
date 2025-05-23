<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">User Config</h2>
    </x-slot>

    <div class="p-4">
        <a href="{{ route('user.config.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah User</a>

        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Role</th>
                    <th class="border p-2">Project</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">{{ strtoupper($user->role) }}</td>
                        <td class="border p-2">{{ $user->project->name ?? '-' }}</td>
                        <td class="border p-2">
                            <a href="{{ route('user.config.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a> |
                            <form action="{{ route('user.config.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus user ini?')" class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
