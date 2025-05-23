<form method="POST" action="{{ $action }}">
    @csrf
    @if ($isEdit) @method('PUT') @endif

    <div class="mb-4">
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Role</label>
        <select name="role" class="w-full border p-2 rounded">
            @foreach (['Admin', 'Officer', 'PM', 'VP QHSE'] as $role)
                <option value="{{ $role }}" @selected(old('role', $user->role ?? '') === $role)>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label>Proyek</label>
        <select name="project_id" class="w-full border p-2 rounded">
            <option value="">-- Pilih Proyek --</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" @selected(old('project_id', $user->project_id ?? '') == $project->id)>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label>PIN (4 digit)</label>
        <input type="number" name="pin" maxlength="4" value="{{ old('pin', $user->pin ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        {{ $isEdit ? 'Update' : 'Simpan' }}
    </button>
</form>
