<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Approval Form</h2>
    </x-slot>

    <div class="p-6">
        @if ($progres->isEmpty())
            <p class="text-gray-500 italic">Tidak ada progres yang menunggu approval.</p>
        @else
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ($progres as $p)
                    <div class="bg-white rounded-md shadow p-4 w-full max-w-full flex flex-col justify-between border">
                        <div class="space-y-1 text-sm text-gray-800">
                            <p><span class="font-semibold text-gray-600">📅 Tanggal:</span> {{ \Carbon\Carbon::parse($p->date)->format('d M Y') }}</p>
                            <p><span class="font-semibold text-gray-600">📈 Progres:</span> {{ $p->percent }}%</p>
                            <p><span class="font-semibold text-gray-600">📝 Keterangan:</span> {{ $p->notes ?? '-' }}</p>
                            <p><span class="font-semibold text-gray-600">👤 Oleh:</span> {{ $p->user->name }}</p>

                            @if($p->evidence)
                                <div class="pt-2">
                                    <img src="{{ asset('storage/' . $p->evidence) }}" class="w-28 h-28 object-cover rounded border shadow-sm">
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 space-y-3">
                            {{-- Form Approve --}}
                            <form action="{{ route('approval.approve', $p->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="password" name="pin" required placeholder="PIN"
                                    class="border p-2 rounded w-28 text-sm focus:ring focus:border-green-400" />

                                <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded text-sm hover:bg-green-600 transition">
                                    Approve
                                </button>
                            </form>

                            {{-- Form Reject --}}
                            <form action="{{ route('approval.reject', $p->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <textarea name="comment" required rows="2" placeholder="Komentar penolakan"
                                    class="border p-2 rounded text-sm w-48 resize-none focus:ring focus:border-red-400"></textarea>

                                <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded text-sm hover:bg-red-600 transition">
                                    Reject
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
