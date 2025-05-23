<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Edit Project</h2>
    </x-slot>
    <div class="p-6">
        @include('projects.form', [
            'action' => route('projects.update', $project),
            'project' => $project,
            'isEdit' => true
        ])
    </div>
</x-app-layout>
