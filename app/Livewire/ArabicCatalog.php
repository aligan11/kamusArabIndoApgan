<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Vocabulary;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Kamus Visual Arab - Indonesia')]
class ArabicCatalog extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'kategori')]
    public ?int $categoryId = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoryId(): void
    {
        $this->resetPage();
    }

    public function selectCategory(?int $categoryId): void
    {
        $this->categoryId = $this->categoryId === $categoryId ? null : $categoryId;

        $this->resetPage();
    }

    public function clearSearch(): void
    {
        $this->search = '';

        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->categoryId = null;

        $this->resetPage();
    }

    public function toggleFavorite(int $vocabularyId): void
    {
        if (! Auth::check()) {
            session(['intended_favorite' => $vocabularyId]);

            $this->redirectRoute('login', navigate: true);

            return;
        }

        Auth::user()->favorites()->toggle($vocabularyId);

        unset($this->favoriteIds);
    }

    /**
     * @return Collection<int, Category>
     */
    #[Computed]
    public function categories(): Collection
    {
        return Category::query()->orderBy('name')->get();
    }

    /**
     * @return array<int, int>
     */
    #[Computed]
    public function favoriteIds(): array
    {
        if (! Auth::check()) {
            return [];
        }

        return Auth::user()->favorites()->pluck('vocabularies.id')->all();
    }

    public function render(): View
    {
        return view('livewire.arabic-catalog', [
            'vocabularies' => Vocabulary::query()
                ->with('category:id,name,slug')
                ->select(['id', 'category_id', 'arabic_text', 'latin_text', 'meaning', 'image_path', 'audio_path', 'is_trending'])
                ->search($this->search)
                ->when($this->categoryId, fn($query) => $query->where('category_id', $this->categoryId))
                ->orderByDesc('is_trending')
                ->orderBy('meaning')
                ->paginate(24),
        ]);
    }
}
