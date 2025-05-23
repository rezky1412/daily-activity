<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit Progres</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('progres.update', $progres) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Tanggal</label>
                <input type="date" name="date" value="{{ old('date', $progres->date) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Capaian Progres (%)</label>
                <input type="number" name="percent" value="{{ old('percent', $progres->percent) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Keterangan</label>
                <textarea name="notes" class="w-full border p-2 rounded">{{ old('notes', $progres->notes) }}</textarea>
            </div>

            <div class="mb-4">
                <label>Evidence (Gambar)</label>
                <input type="file" name="evidence" class="w-full border p-2 rounded">
                @if($progres->evidence)
                    <p class="mt-2"><img src="{{ asset('storage/' . $progres->evidence) }}" class="w-32"></p>
                @endif
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
