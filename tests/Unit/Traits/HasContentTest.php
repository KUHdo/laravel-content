<?php

namespace KUHdo\Content\Tests\Unit\Traits;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;

class HasContentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @Covers \KUHdo\Content\Traits\HasContent::content
     * @return void
     */
    public function testContent()
    {
        $contentable = Contentable::factory()->has(Content::factory())->create();

        $this->assertInstanceOf(Content::class, $contentable->content);
    }

    /**
     * @Covers \KUHdo\Content\Traits\HasContent::getContent
     * @return void
     */
    public function testGetContent()
    {
        $contentable = Contentable::factory()->has(Content::factory())->create();

        $this->assertIsString($contentable->getContent([]));
    }
}
