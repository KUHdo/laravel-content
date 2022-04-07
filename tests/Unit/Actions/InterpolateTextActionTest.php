<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\InterpolateTextAction;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\TestCase;

class InterpolateTextActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\Actions\InterpolateTextAction
     * @return void
     */
    public function testTextValueShouldBeInterpolated()
    {
        $texts = collect([
            [
                'fixture' => new Text([
                    'lang' => 'en',
                    'value' => 'Hello {FIRST_NAME} {LAST_NAME}. {VAR_1} is not {VAR_2}!'
                ]),
                'expected' => new Text([
                    'lang' => 'en',
                    'value' => 'Hello Test User. A is not B!'
                ])
            ],
            [
                'fixture' => new Text([
                    'lang' => 'de',
                    'value' => 'Hallo {FIRST_NAME} {LAST_NAME}. {VAR_1} ist nicht {VAR_2}!'
                ]),
                'expected' => new Text([
                    'lang' => 'de',
                    'value' => 'Hallo Test User. A ist nicht B!'
                ])
            ]
        ]);

        $vars = ['FIRST_NAME' => 'Test', 'LAST_NAME' => 'User', 'VAR_1' => 'A', 'VAR_2' => 'B'];

        $texts->each(function ($text) use ($vars) {
            $actual = (new InterpolateTextAction)($text['fixture'], $vars);

            $this->assertEquals($text['expected'], $actual);
            $this->assertModelMissing($actual);
        });
    }
}
