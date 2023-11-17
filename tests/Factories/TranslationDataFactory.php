<?php

namespace KUHdo\Content\Tests\Factories;

use KUHdo\Content\DataTransferObjects\TranslationData;

class TranslationDataFactory extends Factory
{
    /**
     * Test factory create translation data.
     */
    public function create(array $extra = []): TranslationData
    {
        return new TranslationData(
            key: $extra['key'] ?? $this->faker->word,
            texts: $extra['texts'] ?? collect(config('content.locales'))
                ->map(fn ($locale) => TextDataFactory::new()->create(['lang' => $locale]))
                ->all()
        );
    }
}
