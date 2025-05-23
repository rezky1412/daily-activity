<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">List Progres</h2>
    </x-slot>

    <div class="p-4">
        <a href="{{ route('progres.create') }}" class="bg-blue-500 text-white px-4 py-2 mb-4 inline-block">+ Tambah Progres</a>

        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Progress (%)</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($progres as $p)
                    <tr>
                        <td class="border p-2">{{ $p->date }}</td>
                        <td class="border p-2">{{ $p->percent }}%</td>
                        <td class="border p-2">
                            @php
                                $color = match($p->status) {
                                    'submitted' => 'bg-yellow-200',
                                    'approved_pm', 'approved_vp' => 'bg-green-200',
                                    'rejected' => 'bg-red-200',
                                    default => 'bg-gray-200'
                                };
                            @endphp
                            <span class="px-2 py-1 rounded {{ $color }}">{{ Str::of($p->status)->replace('_', ' ')->title() }}</span>
                        </td>
                        <td>
                            @if ($p->status === 'submitted')
                                <a href="{{ route('progres.edit', $p->id) }}" class="text-blue-600 hover:underline"> Edit</a>
                            @else
                                <span class=""> 🔒 </span>
                            @endif
                            |
                            <a href="{{ route('progres.show', $p->id) }}" class="text-indigo-600 hover:underline">Riwayat</a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
