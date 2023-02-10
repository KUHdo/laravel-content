<?php

namespace KUHdo\Content\Tests\Factories;

use Arr;
use Illuminate\Support\Collection;
use KUHdo\Content\DataTransferObjects\TextData;

class TextDataFactory extends Factory
{
    public function create(array $extra = []): TextData
    {
        return new TextData(
            lang: $extra['lang'] ?? Arr::random(config('content.locales')),
            value: $extra['value'] ?? $this->faker->sentence
        );
    }

    public function createAll(): Collection
    {
        return collect(config('content.locales'))
            ->map(fn($locale) => self::create(['lang' => $locale]));
    }
}
