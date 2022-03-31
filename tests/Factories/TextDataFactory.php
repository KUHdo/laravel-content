<?php

namespace KUHdo\Content\Tests\Factories;

use Arr;
use Illuminate\Support\Collection;
use KUHdo\Content\DataTransferObjects\TextData;

class TextDataFactory extends Factory
{
    /**
     * @param array $extra
     * @return TextData
     */
    public function create(array $extra = []): TextData
    {
        return new TextData(
            lang: $extra['lang'] ?? Arr::random(config('content.locales')),
            value: $extra['value'] ?? $this->faker->sentence
        );
    }

    /**
     * @return Collection
     */
    public function createAll(): Collection
    {
        return collect(config('content.locales'))
            ->map(fn($locale) => self::create(['lang' => $locale]));
    }
}
