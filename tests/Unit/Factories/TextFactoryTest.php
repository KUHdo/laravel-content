<?php

namespace KUHdo\Content\Tests\Unit\Factories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\TestCase;

class TextFactoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\Database\Factories\TextFactory::definition
     * @return void
     */
    public function testTextModelShouldOnlyHasSetLocales()
    {
        config(['content.locales' => ['en', 'de', 'fr']]);

        $texts = Text::factory()->count(100)->make();

        $this->assertEqualsCanonicalizing(
            $texts->pluck('lang')->unique()->toArray(),
            config('content.locales')
        );
    }
}
