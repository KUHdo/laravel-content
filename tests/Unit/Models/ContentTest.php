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
     * @Covers \KUHdo\Content\Models\Content::newFactory
     * @return void
     */
    public function testNewFactory()
    {
        $this->assertInstanceOf(ContentFactory::class, Content::factory());
    }

    /**
     * @Covers \KUHdo\Content\Models\Content::newEloquentBuilder
     * @return void
     */
    public function testNewEloquentBuilder()
    {
        $this->assertInstanceOf(ContentQueryBuilder::class, Content::query());
    }

    /**
     * @Covers \KUHdo\Content\Models\Content::translation
     * @return void
     */
    public function testTranslation()
    {
        $this->assertInstanceOf(Translation::class, (new Content)->translation()->getModel());
    }

    /**
     * @Covers \KUHdo\Content\Models\Content::contentable
     * @return void
     */
    public function testContentable()
    {
        $content = Content::factory()->for(Contentable::factory())->create();

        $this->assertInstanceOf(Contentable::class, $content->contentable()->getModel());
    }

    /**
     * @Covers \KUHdo\Content\Models\Content::getTextAttribute
     * @return void
     */
    public function testGetTextAttribute()
    {
        $content = Content::factory()->for(Contentable::factory())->create();

        $this->assertIsString($content->text);
    }

    /**
     * @Covers \KUHdo\Content\Models\Content::text
     * @return void
     */
    public function testText()
    {
        $content = Content::factory()->for(Contentable::factory())->create();

        $this->assertIsString($content->text([]));
    }
}
