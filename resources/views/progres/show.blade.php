<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Detail Progres</h2>
    </x-slot>

    <div class="p-4 space-y-4">
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="mb-1"><span class="font-semibold text-gray-600">📅 Tanggal:</span> {{ \Carbon\Carbon::parse($progress->date)->format('d M Y') }}</p>
                    <p class="mb-1"><span class="font-semibold text-gray-600">📈 Progress:</span> {{ $progress->percent }}%</p>
                    <p class="mb-1"><span class="font-semibold text-gray-600">📝 Keterangan:</span> {{ $progress->notes ?? '-' }}</p>
                </div>
                <div>
                    <p class="mb-1">
                        <span class="font-semibold text-gray-600">📌 Status:</span>
                        @php
                            $status = strtoupper($progress->status);
                            $color = match($progress->status) {
                                'submitted' => 'bg-yellow-200 text-yellow-800',
                                'approved_pm', 'approved_vp' => 'bg-green-200 text-green-800',
                                'rejected' => 'bg-red-200 text-red-800',
                                default => 'bg-gray-200 text-gray-800',
                            };
                        @endphp
                        <span class="inline-block px-2 py-1 text-xs rounded {{ $color }}">{{ str_replace('_', ' ', ucfirst($progress->status)) }}</span>
                    </p>

                    @if($progress->evidence)
                        <p class="mt-3 font-semibold text-gray-600">🖼 Evidence:</p>
                        <img src="{{ asset('storage/' . $progress->evidence) }}" class="mt-1 w-64 rounded border shadow-sm">
                    @endif
                </div>
            </div>
        </div>


        <div class="mt-8">
            <h3 class="text-xl font-bold mb-4">🧾 Riwayat Approval</h3>

            @forelse ($progress->approvals as $approval)
                @php
                    $bgColor = match($approval->status) {
                        'approved' => 'bg-green-100 border-green-300',
                        'approved_pm' => 'bg-green-100 border-green-300',
                        'approved_vp' => 'bg-green-100 border-green-300',
                        'rejected' => 'bg-red-100 border-red-300',
                        default => 'bg-gray-100 border-gray-300'
                    };

                    $icon = match($approval->status) {
                        'approved_pm', 'approved_vp' => '✅',
                        'rejected' => '❌',
                        default => '🕒'
                    };
                @endphp

                <div class="flex items-center gap-4 p-4 mb-4 border-l-4 rounded shadow-sm {{ $bgColor }}">
                    <div class="text-3xl">{{ $icon }}</div>
                    <div class="flex-1">
                        <div class="text-sm text-gray-600">
                            <strong>{{ strtoupper($approval->role) }}</strong> oleh {{ $approval->approver->name }}
                            <span class="ml-2 text-xs text-gray-500">({{ $approval->created_at->format('d M Y H:i') }})</span>
                        </div>
                        <div class="text-md font-semibold mt-1">Status: {{ ucwords(str_replace('_', ' ', $approval->status)) }}</div>

                        @if($approval->comment)
                            <div class="text-sm mt-1 text-gray-700 italic">“{{ $approval->comment }}”</div>
                        @endif

                        @if($approval->qr_code)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $approval->qr_code) }}" class="w-24 border rounded">
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 italic">Belum ada approval.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>
