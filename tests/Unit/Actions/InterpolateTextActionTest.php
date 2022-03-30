<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use KUHdo\Content\Actions\InterpolateTextAction;
use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\Tests\TestCase;

class InterpolateTextActionTest extends TestCase
{
    /**
     * @covers \KUHdo\Content\Actions\InterpolateTextAction
     * @return void
     */
    public function testTextValueShouldBeInterpolated()
    {
        $texts = collect([
            [
                'fixture' => new TextData(
                    lang: 'en',
                    value: 'Hello {FIRST_NAME} {LAST_NAME}. {VAR_1} is not {VAR_2}!'
                ),
                'expected' => new TextData(
                    lang: 'en',
                    value: 'Hello Test User. A is not B!'
                )
            ],
            [
                'fixture' => new TextData(
                    lang: 'de',
                    value: 'Hallo {FIRST_NAME} {LAST_NAME}. {VAR_1} ist nicht {VAR_2}!'
                ),
                'expected' => new TextData(
                    lang: 'de',
                    value: 'Hallo Test User. A ist nicht B!'
                )
            ]
        ]);

        $vars = ['FIRST_NAME' => 'Test', 'LAST_NAME' => 'User', 'VAR_1' => 'A', 'VAR_2' => 'B'];

        $texts->each(fn($text) => $this->assertEquals(
            $text['expected'],
            (new InterpolateTextAction)($text['fixture'], $vars)
        ));
    }
}
