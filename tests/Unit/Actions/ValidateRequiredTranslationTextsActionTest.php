<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\ValidateRequiredTranslationTextsAction;
use KUHdo\Content\Exceptions\MissingTranslationTextException;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\TestCase;
use Throwable;

class ValidateRequiredTranslationTextsActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests if validated texts are returned.
     *
     * @covers \KUHdo\Content\Actions\ValidateRequiredTranslationTextsAction
     * @throws Throwable
     */
    public function testValidatedTextsShouldBeReturned()
    {
        config(['content.required' => ['en', 'de']]);

        $texts = Text::factory()
            ->count(2)
            ->sequence(['lang' => 'en'], ['lang' => 'de'])
            ->make();

        $result = (new ValidateRequiredTranslationTextsAction)($texts);

        $this->assertEquals($texts, $result);
    }

    /**
     * Tests that exception is thrown.
     *
     * @covers \KUHdo\Content\Actions\ValidateRequiredTranslationTextsAction
     * @throws Throwable
     */
    public function testExceptionShouldBeThrown()
    {
        config(['content.required' => ['en']]);

        $text = Text::factory()->make(['lang' => 'de']);

        $this->expectException(MissingTranslationTextException::class);

        (new ValidateRequiredTranslationTextsAction)($text);
    }
}
