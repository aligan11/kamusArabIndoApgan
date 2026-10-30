<x-layouts.app title="Daftar">
    <main class="mx-auto w-full max-w-md px-4 py-10">
        <div class="mb-6 text-center">
            <span class="mx-auto flex size-12 items-center justify-center rounded-xl bg-emerald-600 font-arabic text-2xl font-bold leading-none text-white">م</span>
            <h1 class="mt-4 text-xl font-bold tracking-tight text-slate-900">Buat akun Muna Kamus</h1>
            <p class="mt-1 text-sm text-slate-500">Gratis, cukup satu menit untuk mulai mengoleksi kosakata.</p>
        </div>

        @if (session('intended_favorite'))
            <div class="mb-5 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                Buat akun dulu untuk menyimpan kosakata ini ke daftar favoritmu.
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4 rounded-2xl border border-slate-200 bg-white p-5">
            @csrf

            <div>
                <label for="name" class="mb-1.5 block text-sm font-medium text-slate-700">Nama</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-50 px-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500/15"
                >
                @error('name')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-50 px-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500/15"
                >
                @error('email')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Kata sandi</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-50 px-3 text-sm text-slate-800 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500/15"
                >
                @error('password')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-slate-700">Ulangi kata sandi</label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="h-11 w-full rounded-lg border border-slate-200 bg-slate-50 px-3 text-sm text-slate-800 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500/15"
                >
            </div>

            <button
                type="submit"
                class="h-11 w-full rounded-lg bg-emerald-600 text-sm font-semibold text-white transition hover:bg-emerald-700 active:scale-[0.99]"
            >
                Daftar
            </button>
        </form>

        <p class="mt-5 text-center text-sm text-slate-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-emerald-700 transition hover:text-emerald-800">Masuk di sini</a>
        </p>
    </main>
</x-layouts.app>
