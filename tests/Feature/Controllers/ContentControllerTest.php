<?php

namespace KUHdo\Content\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Http\Resources\ContentCollection;
use KUHdo\Content\Http\Resources\ContentResource;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;

class ContentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the index method of content controller.
     *
     * @Covers \KUHdo\Content\Http\Controllers\ContentController::index
     */
    public function testIndex(): void
    {
        $contents = Content::factory()->count(10)->for(Contentable::factory())->create();

        $result = $this->get(route('contents.index'));

        $result->assertOk();
        $result->assertJsonCount($contents->count(), 'data');
        $result->assertJson(ContentCollection::make($contents)->response()->getData(true));
    }

    /**
     * Tests the store method of content controller.
     *
     * @Covers \KUHdo\Content\Http\Controllers\ContentController::store
     */
    public function testStore(): void
    {
        config(['content.required' => ['de', 'en']]);
        $key = 'TestKey';
        $texts = Text::factory()
            ->count(3)
            ->sequence(['lang' => 'de'], ['lang' => 'en'], ['lang' => 'es'])
            ->make();
        $contentable = Contentable::factory()->create();

        $data = [
            'key' => $key,
            'texts' => $texts->toArray(),
            'contentable_type' => $contentable::class,
            'contentable_id' => $contentable->id,
        ];

        $result = $this->post(route('contents.store'), $data);

        $content = Content::find($result->json('data.id'));

        $result->assertCreated();
        $result->assertJson(ContentResource::make($content)->response()->getData(true));
    }

    /**
     * Tests the show method of content controller.
     *
     * @Covers \KUHdo\Content\Http\Controllers\ContentController::show
     */
    public function testShow(): void
    {
        $content = Content::factory()->for(Contentable::factory())->create();

        $result = $this->get(route('contents.show', $content));

        $result->assertOk();
        $result->assertJson(ContentResource::make($content)->response()->getData(true));
    }

    /**
     * Tests the update method of content controller.
     *
     * @Covers \KUHdo\Content\Http\Controllers\ContentController::update
     */
    public function testUpdate(): void
    {
        $content = Content::factory()->for(Contentable::factory())->create();
        $data = ['key' => 'testKey123'];

        $result = $this->patch(route('contents.update', $content), $data);

        $content = Content::find($result->json('data.id'));

        $result->assertOk();
        $result->assertJson(ContentResource::make($content)->response()->getData(true));
    }

    /**
     * Tests the destroy method of content controller.
     *
     * @Covers \KUHdo\Content\Http\Controllers\ContentController::destroy
     */
    public function testDestroy(): void
    {
        $content = Content::factory()->for(Contentable::factory())->create();

        $result = $this->delete(route('contents.show', $content));

        $result->assertNoContent();
        $this->assertEquals('', $result->getContent());
    }
}
