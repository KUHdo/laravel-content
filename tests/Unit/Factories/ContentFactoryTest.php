<?php

namespace KUHdo\Content\Tests\Unit\Factories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;

class ContentFactoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the content factory, if a content with full translation, incl. texts gets created.
     *
     * @covers \KUHdo\Content\Database\Factories\ContentFactory::definition
     */
    public function testContentWithFullTranslationShouldBeCreated()
    {
        $content = Content::factory()->for(Contentable::factory())->create();

        $this->assertNotNull($content->translation);
        $this->assertCount(count(config('content.locales')), $content->translation->texts);
    }
}
