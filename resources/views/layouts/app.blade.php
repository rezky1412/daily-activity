<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Daily Activity</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">

            {{-- Sidebar --}}
            <aside class="w-64 bg-white dark:bg-gray-800 border-r hidden md:block">
                <div class="p-4 text-xl font-bold">Progress App</div>
                <nav class="space-y-1 px-4">
                    @php $role = auth()->user()->role; @endphp

                    <a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-300 font-semibold' : '' }}">
                        🏠 Dashboard
                    </a>

                    @if ($role === 'Admin')
                        <a href="{{ route('user.config') }}" class="block p-2 rounded hover:bg-gray-200 {{ request()->routeIs('user.config') ? 'bg-gray-300 font-semibold' : '' }}">
                            👤 User Config
                        </a>
                        <a href="{{ route('projects.index') }}" class="block p-2 rounded hover:bg-gray-200 {{ request()->routeIs('projects.index') ? 'bg-gray-300 font-semibold' : '' }}">
                            🚧 Project
                        </a>
                    @endif

                    @if ($role === 'Officer')
                        <a href="{{ route('progres.index') }}" class="block p-2 rounded hover:bg-gray-200 {{ request()->routeIs('progres.index') ? 'bg-gray-300 font-semibold' : '' }}">
                            📥 Input Progres
                        </a>
                    @endif

                    @if ($role === 'PM')
                        <a href="{{ route('approval.index') }}" class="block p-2 rounded hover:bg-gray-200 {{ request()->routeIs('approval.index') ? 'bg-gray-300 font-semibold' : '' }}">
                            ✅ Approval PM
                        </a>
                    @endif

                    @if ($role === 'VP QHSE')
                        <a href="{{ route('vp.approval.index') }}" class="block p-2 rounded hover:bg-gray-200 {{ request()->routeIs('vp.approval.index') ? 'bg-gray-300 font-semibold' : '' }}">
                            🧾 Approval VP
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left block p-2 rounded hover:bg-red-100 text-red-600">🚪 Logout</button>
                    </form>
                </nav>
            </aside>

            {{-- Main Content --}}
            <div class="flex-1">
                @include('layouts.navigation') {{-- topbar --}}

                <main class="p-4">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>

</html>
