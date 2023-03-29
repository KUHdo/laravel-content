<?php

namespace KUHdo\Content\Tests\Unit\Http\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use KUHdo\Content\Http\Resources\TextResource;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\TestCase;

class TextResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the text resource to array function.
     *
     * @Covers \KUHdo\Content\Http\Resources\TextResource::toArray
     */
    public function testMake()
    {
        $text = Text::factory()->create();

        $resource = (TextResource::make($text))->response()->getData(true);

        $this->assertEquals(
            [
                'data' => [
                    'id' => $text->id,
                    'lang' => $text->lang,
                    'value' => $text->value,
                    'created_at' => Carbon::make($text->created_at)->toIsoString(),
                    'updated_at' => Carbon::make($text->updated_at)->toIsoString(),
                ]
            ],
            $resource
        );
    }
}
