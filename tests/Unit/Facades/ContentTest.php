<?php

namespace KUHdo\Content\Tests\Unit\Facades;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Facades\Content;
use KUHdo\Content\Models\Content as ContentModel;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\Factories\TextDataFactory;
use KUHdo\Content\Tests\Factories\TranslationDataFactory;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;

class ContentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\Content::for
     * @return void
     */
    public function testForMethod()
    {
        $contentable = Contentable::factory()->create();

        $content = Content::for($contentable);

        $this->assertInstanceOf(\KUHdo\Content\Content::class, $content);
    }

    /**
     * @covers \KUHdo\Content\Content::text
     * @return void
     */
    public function testTextMethod()
    {
        $text = Text::factory()->make();

        $content = Content::text(lang: $text->lang, value: $text->value);

        $this->assertInstanceOf(\KUHdo\Content\Content::class, $content);
    }

    /**
     * @covers \KUHdo\Content\Content::texts
     * @return void
     */
    public function testTextsMethod()
    {
        $texts = Text::factory()->count(2)->make();

        $content = Content::texts($texts);

        $this->assertInstanceOf(\KUHdo\Content\Content::class, $content);
    }

    /**
     * @covers \KUHdo\Content\Content::key
     * @return void
     */
    public function testKeyMethod()
    {
        $key = 'TestKey';

        $content = Content::key($key);

        $this->assertInstanceOf(\KUHdo\Content\Content::class, $content);
    }

    /**
     * @covers \KUHdo\Content\Content::save
     * @return void
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
     * @covers \KUHdo\Content\Content::create
     * @return void
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
