<?php

namespace KUHdo\Content\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;

class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->word
        ];
    }

    /**
     * Define the model's full state, incl locale.
     */
    public function full(): static
    {
        return collect(config('content.locales'))
            ->reduce(
                fn($factory, $locale) => $factory->has(Text::factory(['lang' => $locale])),
                $this
            );
    }
}
