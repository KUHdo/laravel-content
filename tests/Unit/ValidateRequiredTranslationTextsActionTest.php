<?php

namespace KUHdo\Content\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\ValidateRequiredTranslationTextsAction;
use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\Exceptions\MissingTranslationTextException;
use KUHdo\Content\Tests\TestCase;
use Throwable;

class ValidateRequiredTranslationTextsActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws Throwable
     */
    public function testValidatedTextsShouldBeReturned()
    {
        config(['content.required' => ['en', 'de']]);

        $texts = [
            new TextData(lang: 'en', value: 'Hello'),
            new TextData(lang: 'de', value: 'Hallo'),
        ];

        $result = (new ValidateRequiredTranslationTextsAction)($texts);

        $this->assertEquals($texts, $result);
    }

    /**
     * @throws Throwable
     */
    public function testExceptionShouldBeThrown()
    {
        config(['content.required' => ['en']]);

        $texts = [
            new TextData(lang: 'de', value: 'Hallo'),
            new TextData(lang: 'en', value: 'Hello'),
        ];

        $this->expectException(MissingTranslationTextException::class);

        (new ValidateRequiredTranslationTextsAction)($texts);
    }
}
