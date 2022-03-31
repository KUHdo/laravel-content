<?php

namespace KUHdo\Content\Tests\Unit\Factories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Tests\TestCase;

class ContentFactoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\Database\Factories\ContentFactory::definition
     * @return void
     */
    public function testContentWithFullTranslationShouldBeCreated()
    {
        $content = Content::factory()->create();

        $this->assertNotNull($content->translation);
        $this->assertCount(count(config('content.locales')), $content->translation->texts);
    }
}
