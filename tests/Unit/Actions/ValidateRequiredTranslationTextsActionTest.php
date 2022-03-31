<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\ValidateRequiredTranslationTextsAction;
use KUHdo\Content\Exceptions\MissingTranslationTextException;
use KUHdo\Content\Tests\Factories\TextDataFactory;
use KUHdo\Content\Tests\TestCase;
use Throwable;

class ValidateRequiredTranslationTextsActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\Actions\ValidateRequiredTranslationTextsAction
     * @throws Throwable
     */
    public function testValidatedTextsShouldBeReturned()
    {
        config(['content.required' => ['en', 'de']]);

        $texts = [
            TextDataFactory::new()->create(['lang' => 'en']),
            TextDataFactory::new()->create(['lang' => 'de']),
        ];

        $result = (new ValidateRequiredTranslationTextsAction)($texts);

        $this->assertEquals($texts, $result);
    }

    /**
     * @covers \KUHdo\Content\Actions\ValidateRequiredTranslationTextsAction
     * @throws Throwable
     */
    public function testExceptionShouldBeThrown()
    {
        config(['content.required' => ['en']]);

        $texts = [
            TextDataFactory::new()->create(['lang' => 'de']),
        ];

        $this->expectException(MissingTranslationTextException::class);

        (new ValidateRequiredTranslationTextsAction)($texts);
    }
}
