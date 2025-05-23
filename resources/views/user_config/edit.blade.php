<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit User</h2>
    </x-slot>

    <div class="p-6">
        @include('user_config.form', [
            'action' => route('user.config.update', $user),
            'user' => $user,
            'isEdit' => true,
            'projects' => $projects
        ])
    </div>
</x-app-layout>
