<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\CreateTranslationAction;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\TestCase;
use Throwable;

class CreateTranslationActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\Actions\CreateTranslationAction
     * @return void
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
     * @covers \KUHdo\Content\Actions\CreateTranslationAction
     * @return void
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
