<?php

namespace KUHdo\Content\Tests\Unit\Factories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\TestCase;

class TranslationFactoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests translation factory creates translation incl. all texts for set locales.
     *
     * @covers \KUHdo\Content\Database\Factories\TranslationFactory::full
     */
    public function testTranslationWithTextsWithAllSetLocalesShouldBeCreated()
    {
        config(['content.locales' => ['en', 'de', 'fr', 'es']]);

        $translation = Translation::factory()->full()->create();

        $this->assertEqualsCanonicalizing(
            $translation->texts->pluck('lang')->toArray(),
            config('content.locales')
        );
    }
}
