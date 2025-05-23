<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tambah Progres</h2>
    </x-slot>

    <div class="p-4">
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form action="{{ route('progres.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label>Tanggal</label>
                <input type="date" name="date" class="border p-2 w-full" required>
            </div>
            <div>
                <label>Capaian Progres (%)</label>
                <input type="number" name="percent" class="border p-2 w-full" required min="0" max="100">
            </div>
            <div>
                <label>Evidence (Gambar)</label>
                <input type="file" name="evidence" accept="image/*" class="border p-2 w-full">
            </div>
            <div>
                <label>Keterangan</label>
                <textarea name="notes" class="border p-2 w-full"></textarea>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2">Simpan</button>
        </form>
    </div>
</x-app-layout>
