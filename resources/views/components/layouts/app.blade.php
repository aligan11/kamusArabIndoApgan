@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#059669">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' · ' . config('app.name') : config('app.name') . ' · Kamus Visual Arab' }}</title>

    {{ Vite::fonts() }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50 font-sans text-slate-800 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex h-14 max-w-7xl items-center justify-between px-3 sm:px-4 lg:px-6">
            <a href="{{ route('catalog') }}" wire:navigate class="flex items-center gap-2">
                <span
                    class="flex size-8 items-center justify-center rounded-md bg-emerald-600 font-arabic text-lg font-bold leading-none text-white">م</span>
                <span class="text-sm font-semibold tracking-tight text-slate-900">
                    Muna <span class="text-emerald-600">Kamus</span>
                </span>
            </a>

            <nav class="flex items-center gap-2 text-sm">
                @auth
                    <span class="hidden max-w-32 truncate text-slate-500 sm:inline">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded-md border border-slate-300 px-3 py-1.5 font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-900">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-2.5 py-1.5 font-medium text-slate-600 transition hover:text-emerald-700">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="rounded-md bg-emerald-600 px-3 py-1.5 font-medium text-white transition hover:bg-emerald-700">
                        Daftar
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    {{ $slot }}

    @if (session('status'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3200)" x-show="show" x-transition.opacity.duration.300ms
            class="fixed inset-x-4 bottom-4 z-50 mx-auto max-w-sm rounded-lg bg-emerald-600 px-4 py-3 text-center text-sm font-medium text-emerald-50 shadow-lg"
            role="status">
            {{ session('status') }}
        </div>
    @endif
</body>

</html>
