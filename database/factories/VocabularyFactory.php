<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Vocabulary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vocabulary>
 */
class VocabularyFactory extends Factory
{
    protected $model = Vocabulary::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        [$arabic, $latin, $meaning] = fake()->randomElement([
            ['كِتَاب', 'kitāb', 'Buku'],
            ['قَلَم', 'qalam', 'Pena'],
            ['بَيْت', 'bayt', 'Rumah'],
            ['مَاء', 'māʾ', 'Air'],
            ['شَمْس', 'shams', 'Matahari'],
            ['قَمَر', 'qamar', 'Bulan'],
            ['طَعَام', 'ṭaʿām', 'Makanan'],
            ['صَدِيق', 'ṣadīq', 'Teman'],
        ]);

        return [
            'category_id' => Category::factory(),
            'arabic_text' => $arabic,
            'latin_text' => $latin,
            'meaning' => $meaning,
            'description' => fake()->sentence(12),
            'example_sentence' => null,
            'image_path' => null,
            'audio_path' => null,
            'is_trending' => fake()->boolean(20),
        ];
    }

    public function trending(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_trending' => true,
        ]);
    }
}
