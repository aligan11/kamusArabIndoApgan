<div class="min-h-screen bg-gray-50 pb-10">

    {{-- Sticky Search Bar --}}
    <div class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/95 backdrop-blur">
        <div class="mx-auto max-w-7xl px-3 sm:px-4 lg:px-6">
            <div class="py-2.5">
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <x-icon name="search" class="size-[18px]" />
                    </span>

                    <input type="search" wire:model.live.debounce.350ms="search" inputmode="search" autocomplete="off"
                        autocapitalize="off" placeholder="Cari kosakata Arab, latin, atau arti…"
                        aria-label="Cari kosakata"
                        class="h-10 w-full rounded-lg border border-slate-200 bg-slate-50 pl-10 pr-11 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-500/15">

                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <span wire:loading wire:target="search"
                            class="size-4 animate-spin rounded-full border-2 border-emerald-500 border-t-transparent"
                            aria-hidden="true"></span>

                        @if ($search !== '')
                            <button type="button" wire:click="clearSearch" wire:loading.remove wire:target="search"
                                class="text-slate-400 transition hover:text-slate-600" aria-label="Hapus kata kunci">
                                <x-icon name="close" class="size-4" />
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Category Rail --}}
    <div class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl">
            <div class="no-scrollbar flex gap-3 overflow-x-auto px-3 py-3 sm:px-4 lg:px-6">
                <button type="button" wire:click="selectCategory(null)"
                    class="flex w-16 shrink-0 flex-col items-center gap-1.5">
                    <span @class([
                        'flex size-14 items-center justify-center rounded-full border transition',
                        'border-emerald-600 bg-emerald-600 text-white shadow-sm shadow-emerald-600/30' =>
                            $categoryId === null,
                        'border-slate-200 bg-white text-slate-500 hover:border-emerald-300 hover:text-emerald-600' =>
                            $categoryId !== null,
                    ])>
                        <x-icon name="grid" class="size-6" />
                    </span>
                    <span @class([
                        'w-full truncate text-center text-[11px] font-medium leading-tight',
                        'text-emerald-700' => $categoryId === null,
                        'text-slate-600' => $categoryId !== null,
                    ])>Semua</span>
                </button>

                @foreach ($this->categories as $category)
                    <button type="button" wire:key="category-{{ $category->id }}"
                        wire:click="selectCategory({{ $category->id }})"
                        class="flex w-16 shrink-0 flex-col items-center gap-1.5">
                        <span @class([
                            'flex size-14 items-center justify-center rounded-full border transition',
                            'border-emerald-600 bg-emerald-600 text-white shadow-sm shadow-emerald-600/30' =>
                                $categoryId === $category->id,
                            'border-slate-200 bg-white text-slate-500 hover:border-emerald-300 hover:text-emerald-600' =>
                                $categoryId !== $category->id,
                        ])>
                            <x-icon :name="$category->icon" class="size-6" />
                        </span>
                        <span @class([
                            'w-full truncate text-center text-[11px] font-medium leading-tight',
                            'text-emerald-700' => $categoryId === $category->id,
                            'text-slate-600' => $categoryId !== $category->id,
                        ])>{{ $category->name }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Results --}}
    <div class="mx-auto max-w-7xl px-3 sm:px-4 lg:px-6">
        <div class="flex items-baseline justify-between py-3">
            <h1 class="text-sm font-semibold text-slate-700">
                @if ($search !== '')
                    Hasil untuk “{{ $search }}”
                @else
                    Kosakata populer
                @endif
            </h1>
            <p class="text-xs text-slate-400">{{ $vocabularies->total() }} kosakata</p>
        </div>

        @if ($vocabularies->isEmpty())
            <div
                class="flex flex-col items-center justify-center gap-3 rounded-xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                <span class="flex size-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                    <x-icon name="search" class="size-6" />
                </span>
                <div>
                    <p class="text-sm font-semibold text-slate-700">Kosakata tidak ditemukan</p>
                    <p class="mt-1 text-xs text-slate-500">Coba kata kunci lain atau pilih kategori yang berbeda.</p>
                </div>
                <button type="button" wire:click="resetFilters"
                    class="mt-1 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700">
                    Reset pencarian
                </button>
            </div>
        @else
            <div wire:loading.class="opacity-50" wire:target="search, selectCategory, categoryId"
                class="grid grid-cols-2 gap-2.5 transition-opacity duration-200 sm:gap-3 lg:grid-cols-4 xl:grid-cols-5">
                @foreach ($vocabularies as $vocabulary)
                    <article wire:key="vocabulary-{{ $vocabulary->id }}"
                        class="group relative flex flex-col overflow-hidden rounded-xl border border-slate-200 bg-white transition hover:-translate-y-0.5 hover:border-emerald-300 hover:shadow-lg hover:shadow-slate-200/70">
                        <a href="{{ route('vocabulary.show', $vocabulary) }}" wire:navigate
                            class="relative block aspect-square overflow-hidden bg-slate-100">
                            @if ($vocabulary->image_url)
                                <img src="{{ $vocabulary->image_url }}" alt="{{ $vocabulary->meaning }}" loading="lazy"
                                    decoding="async"
                                    class="size-full object-cover transition duration-300 group-hover:scale-105">
                            @else
                                <span
                                    class="flex size-full items-center justify-center bg-emerald-50 font-arabic text-4xl font-semibold text-emerald-600"
                                    dir="rtl" lang="ar">
                                    {{ $vocabulary->arabic_text }}
                                </span>
                            @endif

                            @if ($vocabulary->is_trending)
                                <span
                                    class="absolute left-1.5 top-1.5 inline-flex items-center gap-0.5 rounded-full bg-amber-500 px-1.5 py-0.5 text-[10px] font-semibold text-white shadow-sm">
                                    <x-icon name="star" class="size-3" fill="currentColor" stroke="none" />
                                    Trending
                                </span>
                            @endif
                        </a>

                        <button type="button" wire:click="toggleFavorite({{ $vocabulary->id }})"
                            wire:loading.attr="disabled" title="Simpan ke favorit"
                            aria-label="Simpan {{ $vocabulary->meaning }} ke favorit"
                            class="absolute right-1.5 top-1.5 flex size-8 items-center justify-center rounded-full bg-white/90 text-slate-500 shadow-sm backdrop-blur transition hover:scale-105 active:scale-95">
                            <x-icon name="heart" @class([
                                'size-[18px] transition',
                                'text-amber-500' => in_array($vocabulary->id, $this->favoriteIds, true),
                            ])
                                fill="{{ in_array($vocabulary->id, $this->favoriteIds, true) ? 'currentColor' : 'none' }}" />
                        </button>

                        <div class="flex flex-1 flex-col gap-1 p-2.5">
                            <p dir="rtl" lang="ar"
                                class="font-arabic text-2xl font-semibold leading-[1.7] text-slate-900">
                                {{ $vocabulary->arabic_text }}
                            </p>
                            <p class="truncate text-xs italic text-slate-500">{{ $vocabulary->latin_text }}</p>
                            <p class="mt-0.5 line-clamp-2 text-sm font-semibold text-emerald-700">
                                {{ $vocabulary->meaning }}</p>

                            @if ($vocabulary->category)
                                <p
                                    class="mt-auto pt-1.5 text-[10px] font-medium uppercase tracking-wide text-slate-400">
                                    {{ $vocabulary->category->name }}
                                </p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

            @if ($vocabularies->hasPages())
                <div class="mt-6">
                    {{ $vocabularies->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
