<?php

namespace KUHdo\Content\Tests\Unit\Facades;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Facades\Content;
use KUHdo\Content\Models\Content as ContentModel;
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
        $text = TextDataFactory::new()->create();

        $content = Content::text(lang: $text->lang, value: $text->value);

        $this->assertInstanceOf(\KUHdo\Content\Content::class, $content);
    }

    /**
     * @covers \KUHdo\Content\Content::texts
     * @return void
     */
    public function testTextsMethod()
    {
        $texts = TextDataFactory::new()->createAll();

        $content = Content::texts($texts->all());

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
        $contentable = Contentable::factory()->create();
        $translation = TranslationDataFactory::new()->create();

        $content = Content::for($contentable)
            ->key($translation->key)
            ->texts($translation->texts)
            ->save();

        $this->assertInstanceOf(ContentModel::class, $content);
    }

    /**
     * @covers \KUHdo\Content\Content::create
     * @return void
     */
    public function testCreateMethod()
    {
        $contentable = Contentable::factory()->create();
        $translation = TranslationDataFactory::new()->create();

        $content = Content::create(
            contentable: $contentable,
            texts: $translation->texts,
            key: $translation->key
        );

        $this->assertInstanceOf(ContentModel::class, $content);
    }
}
