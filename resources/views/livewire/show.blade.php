@php
    $hasAudio = filled($vocabulary->audio_url);
@endphp

<div class="min-h-screen bg-gray-50 pb-28 lg:pb-12" x-data="{
    playing: false,
    audio: null,
    init() {
        @if ($hasAudio) this.audio = new Audio(@js($vocabulary->audio_url));
                this.audio.addEventListener('play', () => this.playing = true);
                this.audio.addEventListener('ended', () => this.playing = false);
                this.audio.addEventListener('pause', () => this.playing = false); @endif
    },
    play() {
        if (!this.audio) return;
        if (this.playing) {
            this.audio.pause();
            this.audio.currentTime = 0;
            return;
        }
        this.audio.currentTime = 0;
        this.audio.play();
    },
}">
    {{-- Sticky Sub Header --}}
    <div class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex h-14 max-w-6xl items-center gap-2 px-3 sm:px-4 lg:px-6">
            <a href="{{ route('catalog') }}" wire:navigate
                class="-ml-1.5 flex size-9 items-center justify-center rounded-full text-slate-600 transition hover:bg-slate-100"
                aria-label="Kembali ke katalog">
                <x-icon name="arrow-left" class="size-5" />
            </a>

            <p class="flex-1 truncate text-sm font-semibold text-slate-800">Detail Kosakata</p>

            <button type="button" wire:click="toggleFavorite" wire:loading.attr="disabled"
                class="flex size-9 items-center justify-center rounded-full text-slate-500 transition hover:bg-amber-50"
                aria-label="Simpan ke favorit">
                <x-icon name="heart" @class(['size-5 transition', 'text-amber-500' => $this->isFavorited])
                    fill="{{ $this->isFavorited ? 'currentColor' : 'none' }}" />
            </button>
        </div>
    </div>

    <div class="mx-auto max-w-6xl lg:px-6">
        {{-- Breadcrumb --}}
        <nav class="hidden items-center gap-1.5 px-1 py-4 text-xs text-slate-400 lg:flex">
            <a href="{{ route('catalog') }}" wire:navigate class="transition hover:text-emerald-700">Katalog</a>
            <span aria-hidden="true">/</span>
            @if ($vocabulary->category)
                <a href="{{ route('catalog', ['kategori' => $vocabulary->category_id]) }}" wire:navigate
                    class="transition hover:text-emerald-700">{{ $vocabulary->category->name }}</a>
                <span aria-hidden="true">/</span>
            @endif
            <span class="truncate font-medium text-slate-600">{{ $vocabulary->meaning }}</span>
        </nav>

        <div class="grid gap-0 lg:grid-cols-2 lg:gap-8 lg:pb-8">
            {{-- Media --}}
            <div class="relative overflow-hidden bg-white lg:rounded-2xl lg:border lg:border-slate-200">
                <div class="relative aspect-square w-full bg-slate-100">
                    @if ($vocabulary->image_url)
                        <img src="{{ $vocabulary->image_url }}" alt="{{ $vocabulary->meaning }}"
                            class="size-full object-cover">
                    @else
                        <span
                            class="flex size-full items-center justify-center bg-emerald-50 font-arabic text-8xl font-semibold text-emerald-600"
                            dir="rtl" lang="ar">{{ $vocabulary->arabic_text }}</span>
                    @endif

                    @if ($vocabulary->is_trending)
                        <span
                            class="absolute left-3 top-3 inline-flex items-center gap-1 rounded-full bg-amber-500 px-2.5 py-1 text-[11px] font-semibold text-white shadow-sm">
                            <x-icon name="star" class="size-3.5" fill="currentColor" stroke="none" />
                            Trending
                        </span>
                    @endif
                </div>
            </div>

            {{-- Details --}}
            <div class="bg-white px-4 py-5 lg:rounded-2xl lg:border lg:border-slate-200 lg:px-6 lg:py-6">
                @if ($vocabulary->category)
                    <a href="{{ route('catalog', ['kategori' => $vocabulary->category_id]) }}" wire:navigate
                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700 transition hover:bg-emerald-100">
                        <x-icon :name="$vocabulary->category->icon" class="size-3.5" />
                        {{ $vocabulary->category->name }}
                    </a>
                @endif

                <p dir="rtl" lang="ar"
                    class="mt-4 font-arabic text-5xl font-semibold leading-[1.6] text-slate-900">
                    {{ $vocabulary->arabic_text }}
                </p>

                <p class="mt-2 text-base italic text-slate-500">{{ $vocabulary->latin_text }}</p>

                <p class="mt-4 text-2xl font-bold text-emerald-700">{{ $vocabulary->meaning }}</p>

                <div class="mt-5">
                    <button type="button" x-on:click="play()" x-bind:disabled="!audio"
                        x-bind:class="playing
                            ?
                            'bg-amber-500 text-white shadow-sm shadow-amber-500/30' :
                            'bg-emerald-600 text-white hover:bg-emerald-700'"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold transition disabled:cursor-not-allowed disabled:bg-slate-200 disabled:text-slate-400 sm:w-auto">
                        <x-icon name="speaker" class="size-5" />
                        <span x-text="playing ? 'Berhenti' : 'Dengarkan makhraj'">Dengarkan makhraj</span>
                    </button>

                    @unless ($hasAudio)
                        <p class="mt-2 text-xs text-slate-400">Rekaman audio belum tersedia untuk kosakata ini.</p>
                    @endunless
                </div>

                @if (filled($vocabulary->description))
                    <div class="mt-6 border-t border-slate-100 pt-5">
                        <h2 class="text-xs font-semibold uppercase tracking-wide text-slate-400">Deskripsi</h2>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $vocabulary->description }}</p>
                    </div>
                @endif

                @if (filled($vocabulary->example_sentence))
                    <div class="mt-5">
                        <h2 class="text-xs font-semibold uppercase tracking-wide text-slate-400">Contoh Penggunaan</h2>
                        <div class="mt-2 rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <p dir="rtl" lang="ar" class="font-arabic text-2xl leading-loose text-slate-800">
                                {{ $vocabulary->example_sentence }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Related --}}
        @if ($this->related->isNotEmpty())
            <section class="px-3 pb-6 pt-6 sm:px-4 lg:px-0">
                <div class="mb-3 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-slate-700">Kosakata Serupa</h2>
                    @if ($vocabulary->category)
                        <a href="{{ route('catalog', ['kategori' => $vocabulary->category_id]) }}" wire:navigate
                            class="text-xs font-medium text-emerald-700 transition hover:text-emerald-800">Lihat
                            semua</a>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-2.5 sm:grid-cols-3 sm:gap-3 lg:grid-cols-5">
                    @foreach ($this->related as $related)
                        <a wire:key="related-{{ $related->id }}" href="{{ route('vocabulary.show', $related) }}"
                            wire:navigate
                            class="group flex flex-col overflow-hidden rounded-xl border border-slate-200 bg-white transition hover:-translate-y-0.5 hover:border-emerald-300 hover:shadow-lg hover:shadow-slate-200/70">
                            <span class="relative block aspect-square overflow-hidden bg-slate-100">
                                @if ($related->image_url)
                                    <img src="{{ $related->image_url }}" alt="{{ $related->meaning }}" loading="lazy"
                                        decoding="async"
                                        class="size-full object-cover transition duration-300 group-hover:scale-105">
                                @else
                                    <span
                                        class="flex size-full items-center justify-center bg-emerald-50 font-arabic text-3xl font-semibold text-emerald-600"
                                        dir="rtl" lang="ar">
                                        {{ $related->arabic_text }}
                                    </span>
                                @endif

                                @if ($related->is_trending)
                                    <span
                                        class="absolute left-1.5 top-1.5 rounded-full bg-amber-500 px-1.5 py-0.5 text-[10px] font-semibold text-white shadow-sm">
                                        Trending
                                    </span>
                                @endif
                            </span>

                            <span class="flex flex-1 flex-col gap-1 p-2.5">
                                <span dir="rtl" lang="ar"
                                    class="font-arabic text-xl font-semibold leading-[1.7] text-slate-900">
                                    {{ $related->arabic_text }}
                                </span>
                                <span
                                    class="truncate text-[11px] italic text-slate-500">{{ $related->latin_text }}</span>
                                <span
                                    class="line-clamp-1 text-sm font-semibold text-emerald-700">{{ $related->meaning }}</span>
                            </span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>

    {{-- Mobile Action Bar --}}
    <div
        class="fixed inset-x-0 bottom-0 z-40 border-t border-slate-200 bg-white px-3 pt-2.5 pb-[max(0.625rem,env(safe-area-inset-bottom))] lg:hidden">
        <div class="flex items-center gap-2">
            <button type="button" wire:click="toggleFavorite" wire:loading.attr="disabled"
                class="flex size-11 shrink-0 items-center justify-center rounded-xl border border-slate-200 text-slate-500 transition active:scale-95"
                aria-label="Simpan ke favorit">
                <x-icon name="heart" @class(['size-5 transition', 'text-amber-500' => $this->isFavorited])
                    fill="{{ $this->isFavorited ? 'currentColor' : 'none' }}" />
            </button>

            <button type="button" x-on:click="play()" x-bind:disabled="!audio"
                x-bind:class="playing ? 'bg-amber-500' : 'bg-emerald-600'"
                class="flex h-11 flex-1 items-center justify-center gap-2 rounded-xl text-sm font-semibold text-white transition active:scale-[0.98] disabled:bg-slate-200 disabled:text-slate-400">
                <x-icon name="speaker" class="size-5" />
                <span x-text="playing ? 'Berhenti' : 'Dengarkan makhraj'">Dengarkan makhraj</span>
            </button>
        </div>
    </div>
</div>
