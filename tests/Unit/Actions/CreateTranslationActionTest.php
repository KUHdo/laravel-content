<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\CreateTranslationAction;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\TestCase;
use Throwable;

class CreateTranslationActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests translation creates action.
     *
     * @covers \KUHdo\Content\Actions\CreateTranslationAction
     * @throws Throwable
     */
    public function testTranslationShouldBeCreated()
    {
        $texts = Text::factory()
            ->count(2)
            ->sequence(['lang' => 'en'], ['lang' => 'de'])
            ->make();
        $key = 'TestKey';

        $translation = (new CreateTranslationAction)($texts, $key);

        $this->assertModelExists($translation);
        $this->assertEquals($translation->key, $key);
    }

    /**
     * Tests translation should have key based on default locale text.
     *
     * @covers \KUHdo\Content\Actions\CreateTranslationAction
     * @throws Throwable
     */
    public function testTranslationShouldHaveKeyBasedOnDefaultLocaleText()
    {
        $default = 'de';
        config(['content.default' => $default]);

        $texts = Text::factory()
            ->count(2)
            ->sequence(['lang' => 'en'], ['lang' => 'de'])
            ->make();

        $translation = (new CreateTranslationAction)($texts);

        $this->assertEquals(
            $translation->key,
            $texts->where('lang', $default)->first()->value
        );
    }
}
