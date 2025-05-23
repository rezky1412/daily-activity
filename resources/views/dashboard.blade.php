<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Dashboard</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <div class="p-4 bg-white rounded shadow">
            <h3 class="text-lg font-semibold">Halo, {{ auth()->user()->name }}</h3>
            <p class="text-sm text-gray-600">Role: {{ ucfirst(auth()->user()->role) }}</p>
        </div>

        @if (auth()->user()->role === 'Admin')
            <div class="p-4 bg-blue-100 rounded">👤 Administrator.</div>
        @elseif (auth()->user()->role === 'Officer')
            <div class="p-4 bg-green-100 rounded">📥 Input progres harian.</div>
        @elseif (auth()->user()->role === 'PM')
            <div class="p-4 bg-yellow-100 rounded">✅ Lihat dan approve progres dari officer.</div>
        @elseif (auth()->user()->role === 'VP QHSE')
            <div class="p-4 bg-purple-100 rounded">🧾 Approve progres yang sudah diverifikasi PM.</div>
        @endif

        @if(auth()->user()->role === 'PM' || auth()->user()->role === 'VP QHSE')
            @php
                $progres = \App\Models\Progres::whereHas('user', fn($q) => $q->where('project_id', auth()->user()->project_id))->get();
                $submitted = $progres->where('status', 'submitted')->count();
                $approved = $progres->where('status', 'approved_vp')->count();
                $rejected = $progres->where('status', 'rejected')->count();
            @endphp

            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="p-4 bg-white rounded shadow">📤 Submitted: {{ $submitted }}</div>
                <div class="p-4 bg-green-100 rounded shadow">✅ Approved: {{ $approved }}</div>
                <div class="p-4 bg-red-100 rounded shadow">❌ Rejected: {{ $rejected }}</div>
            </div>
        @endif

    </div>
</x-app-layout>

