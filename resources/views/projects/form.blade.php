<form method="POST" action="{{ $action }}">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="mb-4">
        <label>Nama Proyek</label>
        <input type="text" name="name" value="{{ old('name', $project->name ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">{{ $isEdit ? 'Update' : 'Simpan' }}</button>
</form>
