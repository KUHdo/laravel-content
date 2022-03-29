<?php

namespace KUHdo\Content\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;

class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->word
        ];
    }

    /**
     * @return $this
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
