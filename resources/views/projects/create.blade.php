<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tambah Project</h2>
    </x-slot>
    <div class="p-6">
        @include('projects.form', ['action' => route('projects.store'), 'isEdit' => false])
    </div>
</x-app-layout>
