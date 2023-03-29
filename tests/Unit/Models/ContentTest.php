<?php

namespace KUHdo\Content\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Database\Factories\ContentFactory;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\QueryBuilders\ContentQueryBuilder;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;

class ContentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the content model new factory.
     *
     * @Covers \KUHdo\Content\Models\Content::newFactory
     */
    public function testNewFactory()
    {
        $this->assertInstanceOf(ContentFactory::class, Content::factory());
    }

    /**
     * Tests the content model new eloquent builder.
     *
     * @Covers \KUHdo\Content\Models\Content::newEloquentBuilder
     */
    public function testNewEloquentBuilder()
    {
        $this->assertInstanceOf(ContentQueryBuilder::class, Content::query());
    }

    /**
     * Tests the content model relation to translation.
     *
     * @Covers \KUHdo\Content\Models\Content::translation
     */
    public function testTranslation()
    {
        $this->assertInstanceOf(Translation::class, (new Content)->translation()->getModel());
    }

    /**
     * Tests the content model contentable.
     *
     * @Covers \KUHdo\Content\Models\Content::contentable
     */
    public function testContentable()
    {
        $content = Content::factory()->for(Contentable::factory())->create();

        $this->assertInstanceOf(Contentable::class, $content->contentable()->getModel());
    }

    /**
     * Tests the content model get text attribute.
     *
     * @Covers \KUHdo\Content\Models\Content::getTextAttribute
     */
    public function testGetTextAttribute()
    {
        $content = Content::factory()->for(Contentable::factory())->create();

        $this->assertIsString($content->text);
    }

    /**
     * Tests the content model relation to text.
     *
     * @Covers \KUHdo\Content\Models\Content::text
     */
    public function testText()
    {
        $content = Content::factory()->for(Contentable::factory())->create();

        $this->assertIsString($content->text([]));
    }
}
