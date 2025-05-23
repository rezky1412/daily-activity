<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">List Project</h2>
    </x-slot>

    <div class="p-4">
        <a href="{{ route('projects.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Proyek</a>

        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td class="border p-2">{{ $project->name }}</td>
                        <td class="border p-2">
                            <a href="{{ route('projects.edit', $project) }}" class="text-blue-600">Edit</a> |
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2" onclick="return confirm('Hapus proyek ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
