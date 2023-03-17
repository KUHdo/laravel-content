<?php

namespace KUHdo\Content\Tests\Unit\Facades;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Facades\Content;
use KUHdo\Content\Models\Content as ContentModel;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;

class ContentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests if a contentable is created.
     *
     * @covers \KUHdo\Content\Content::for
     */
    public function testForMethod()
    {
        $contentable = Contentable::factory()->create();

        $content = Content::for($contentable);

        $this->assertInstanceOf(\KUHdo\Content\Content::class, $content);
    }

    /**
     * Tests if a text is created in the content class.
     *
     * @covers \KUHdo\Content\Content::text
     */
    public function testTextMethod()
    {
        $text = Text::factory()->make();

        $content = Content::text(lang: $text->lang, value: $text->value);

        $this->assertInstanceOf(\KUHdo\Content\Content::class, $content);
    }

    /**
     * Tests if texts are created in the content class.
     *
     * @covers \KUHdo\Content\Content::texts
     */
    public function testTextsMethod()
    {
        $texts = Text::factory()->count(2)->make();

        $content = Content::texts($texts);

        $this->assertInstanceOf(\KUHdo\Content\Content::class, $content);
    }

    /**
     * Tests if a translation key is created in the content class.
     *
     * @covers \KUHdo\Content\Content::key
     */
    public function testKeyMethod()
    {
        $key = 'TestKey';

        $content = Content::key($key);

        $this->assertInstanceOf(\KUHdo\Content\Content::class, $content);
    }

    /**
     * Tests the save method of the content class.
     *
     * @covers \KUHdo\Content\Content::save
     */
    public function testSaveMethod()
    {
        config(['content.required' => 'en']);
        $contentable = Contentable::factory()->create();
        $texts = Text::factory()->count(2)->sequence(['lang' => 'en'], ['lang' => 'de'])->make();
        $key = 'TestKey';

        $content = Content::for($contentable)
            ->key($key)
            ->texts($texts)
            ->save();

        $this->assertInstanceOf(ContentModel::class, $content);
    }

    /**
     * Tests the create method of the content class.
     *
     * @covers \KUHdo\Content\Content::create
     */
    public function testCreateMethod()
    {
        config(['content.required' => 'en']);
        $contentable = Contentable::factory()->create();
        $texts = Text::factory()->count(2)->sequence(['lang' => 'en'], ['lang' => 'de'])->make();
        $key = 'TestKey';

        $content = Content::create(
            contentable: $contentable,
            texts: $texts,
            key: $key
        );

        $this->assertInstanceOf(ContentModel::class, $content);
    }
}
