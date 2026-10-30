<?php

namespace App\Livewire;

use App\Models\Vocabulary;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
class VocabularyDetail extends Component
{
    public Vocabulary $vocabulary;

    public function toggleFavorite(): void
    {
        if (! Auth::check()) {
            session(['intended_favorite' => $this->vocabulary->id]);

            $this->redirectRoute('login', navigate: true);

            return;
        }

        Auth::user()->favorites()->toggle($this->vocabulary->id);

        unset($this->isFavorited);
    }

    #[Computed]
    public function isFavorited(): bool
    {
        if (! Auth::check()) {
            return false;
        }

        return Auth::user()->favorites()->whereKey($this->vocabulary->id)->exists();
    }

    /**
     * @return Collection<int, Vocabulary>
     */
    #[Computed]
    public function related(): Collection
    {
        return Vocabulary::query()
            ->with('category:id,name,slug')
            ->select(['id', 'category_id', 'arabic_text', 'latin_text', 'meaning', 'image_path', 'is_trending'])
            ->where('category_id', $this->vocabulary->category_id)
            ->whereKeyNot($this->vocabulary->getKey())
            ->orderByDesc('is_trending')
            ->orderBy('meaning')
            ->limit(8)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.show')->title($this->vocabulary->meaning);
    }
}
