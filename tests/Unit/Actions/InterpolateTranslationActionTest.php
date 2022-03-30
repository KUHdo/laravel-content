<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use KUHdo\Content\Actions\InterpolateTextAction;
use KUHdo\Content\Actions\InterpolateTranslationAction;
use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\DataTransferObjects\TranslationData;
use KUHdo\Content\Tests\TestCase;

class InterpolateTranslationActionTest extends TestCase
{
    /**
     * @covers \KUHdo\Content\Actions\InterpolateTranslationAction
     * @return void
     */
    public function testTextValueShouldBeInterpolated()
    {
        $fixture = [
            new TextData(
                lang: 'en',
                value: 'Hello {FIRST_NAME} {LAST_NAME}. {VAR_1} is not {VAR_2}!'
            ),
            new TextData(
                lang: 'de',
                value: 'Hallo {FIRST_NAME} {LAST_NAME}. {VAR_1} ist nicht {VAR_2}!'
            )
        ];
        $vars = [
            'FIRST_NAME' => 'Test',
            'LAST_NAME' => 'User',
            'VAR_1' => 'A',
            'VAR_2' => 'B'
        ];

        $expected = new TranslationData(
            texts: array_map(fn($text) => (new InterpolateTextAction)($text, $vars), $fixture)
        );
        $actual = (new InterpolateTranslationAction)(new TranslationData(texts: $fixture), $vars);

        $this->assertEquals($expected, $actual);
    }
}
