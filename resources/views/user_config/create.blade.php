<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tambah User</h2>
    </x-slot>

    <div class="p-6">
        @include('user_config.form', [
            'action' => route('user.config.store'),
            'user' => new \App\Models\User(),
            'isEdit' => false,
            'projects' => $projects
        ])
    </div>
</x-app-layout>
