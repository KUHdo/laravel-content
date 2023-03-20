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
     * Test the has contents trait contents method.
     *
     * @Covers \KUHdo\Content\Traits\HasContent::contents
     */
    public function testContent()
    {
        $contentable = Contentable::factory()->has(Content::factory())->create();

        $this->assertInstanceOf(Content::class, $contentable->contents->first());
    }

    /**
     * Test the has contents trait getContent.
     *
     * @Covers \KUHdo\Content\Traits\HasContent::getContent
     */
    public function testGetContent()
    {
        $contentable = Contentable::factory()->has(Content::factory())->create();

        $this->assertIsString($contentable->getContent($contentable->contents->first()->translation->key));
    }
}
