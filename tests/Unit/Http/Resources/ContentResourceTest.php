<?php

namespace KUHdo\Content\Tests\Unit\Http\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use KUHdo\Content\Http\Resources\ContentResource;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;

class ContentResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @Covers \KUHdo\Content\Http\Resources\ContentResource::toArray
     */
    public function testMake()
    {
        $content = Content::factory()->for(Contentable::factory())->create();
        $resource = (new ContentResource($content))->response()->getData(true);

        $this->assertEquals(
            [
                'data' => [
                    'id' => $content->id,
                    'key' => $content->translation->key,
                    'lang' => $content->translation->currentText->lang,
                    'text' => $content->translation->currentText->value,
                    'contentable_type' => $content->contentable::class,
                    'contentable_id' => $content->contentable->id,
                    'created_at' => Carbon::make($content->created_at)->toIsoString(),
                    'updated_at' => Carbon::make($content->updated_at)->toIsoString(),
                ]
            ],
            $resource
        );
    }
}
