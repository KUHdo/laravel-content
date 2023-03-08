<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\CreateContentAction;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;

class CreateContentActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\Actions\CreateContentAction
     */
    public function testContentShouldBeCreated()
    {
        $translation = Translation::factory()->create();
        $contentable = Contentable::factory()->create();

        $content = (new CreateContentAction)($contentable, $translation);

        $this->assertModelExists($content);
        $this->assertNotNull($content->translation);
        $this->assertModelExists($content->translation);
        $this->assertEquals($contentable, $content->contentable);
        $this->assertNotNull($contentable->content);
    }
}
