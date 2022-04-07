<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\InterpolateTranslationAction;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\TestCase;

class InterpolateTranslationActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\Actions\InterpolateTranslationAction
     * @return void
     */
    public function testTextValueShouldBeInterpolated()
    {
        $translation = Translation::factory()
            ->has(Text::factory([
                'lang' => 'en',
                'value' => 'Hello {FIRST_NAME} {LAST_NAME}. {VAR_1} is not {VAR_2}!'
            ]))
            ->has(Text::factory([
                'lang' => 'de',
                'value' => 'Hallo {FIRST_NAME} {LAST_NAME}. {VAR_1} ist nicht {VAR_2}!'
            ]))
            ->create();

        $vars = [
            'FIRST_NAME' => 'Test',
            'LAST_NAME' => 'User',
            'VAR_1' => 'A',
            'VAR_2' => 'B'
        ];

        $actual = (new InterpolateTranslationAction)($translation, $vars);

        $this->assertEquals('Hello Test User. A is not B!', $actual->texts->where('lang', 'en')->first()->value);
        $this->assertEquals('Hallo Test User. A ist nicht B!', $actual->texts->where('lang', 'de')->first()->value);
        $this->assertInstanceOf(Translation::class, $actual);
        $this->assertModelMissing($actual);
    }
}
