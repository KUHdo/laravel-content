<?php

namespace KUHdo\Content\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Http\Resources\TextCollection;
use KUHdo\Content\Http\Resources\TextResource;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;

class TextControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the index method of the text controller.
     *
     * @Covers \KUHdo\Content\Http\Controllers\TextController::index
     */
    public function testIndex(): void
    {
        $translation = Translation::factory()->full()->has(Text::factory(['lang' => 'de']))->create();
        $content = Content::factory()->for(Contentable::factory())->for($translation)->create();

        $response = $this->get(route('contents.texts.index', $content));

        $response->assertOk();
        $response->assertJson(TextCollection::make($translation->texts)->response()->getData(true));
    }

    /**
     * Tests the store method of the text controller.
     *
     * @Covers \KUHdo\Content\Http\Controllers\TextController::store
     */
    public function testStore(): void
    {
        $content = Content::factory()->for(Contentable::factory())->create();
        $data = [
            'lang' => 'de',
            'value' => 'Hallo Welt!',
        ];

        $response = $this->post(route('contents.texts.store', $content), $data);

        $text = Text::find($response->json('data.id'));

        $response->assertCreated();
        $response->assertJson(TextResource::make($text)->response()->getData(true));
    }

    /**
     * Tests the show method of the text controller.
     *
     * @Covers \KUHdo\Content\Http\Controllers\TextController::show
     */
    public function testShow(): void
    {
        $content = Content::factory()->for(Contentable::factory())->create();
        $text = $content->translation->texts()->get()->random();

        $response = $this->get(route('texts.show', $text));

        $response->assertOk();
        $response->assertJson(TextResource::make($text)->response()->getData(true));
    }

    /**
     * Tests the update method of the text controller.
     *
     * @Covers \KUHdo\Content\Http\Controllers\TextController::update
     */
    public function testUpdate(): void
    {
        $content = Content::factory()->for(Contentable::factory())->create();
        $text = $content->translation->texts()->get()->random();
        $data = [
            'value' => 'Hello World!',
        ];

        $response = $this->patch(route('contents.texts.update', ['content' => $content, 'text' => $text]), $data);

        $response->assertOk();
    }

    /**
     * Tests the destroy method of the text controller.
     *
     * @Covers \KUHdo\Content\Http\Controllers\TextController::destroy
     */
    public function testDestroy(): void
    {
        config(['content.required' => ['de']]);
        $content = Content::factory()->for(Contentable::factory())->create();
        $text = $content->translation->texts()->firstWhere('lang', 'en');

        $response = $this->delete(route('contents.texts.update', ['content' => $content, 'text' => $text]));

        $response->assertNoContent();
    }
}
