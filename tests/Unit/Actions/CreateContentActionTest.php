<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\CreateContentAction;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\Factories\TranslationDataFactory;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;
use Throwable;

class CreateContentActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\Actions\CreateContentAction
     * @return void
     * @throws Throwable
     */
    public function testContentShouldBeCreated()
    {
        $translation = TranslationDataFactory::new()->create();
        $contentable = Contentable::factory()->create();

        $content = (new CreateContentAction)($contentable, $translation);

        $this->assertModelExists($content);
        $this->assertNotNull($content->translation);
        $this->assertModelExists($content->translation);
        $this->assertEquals($contentable, $content->contentable);
        $this->assertNotNull($contentable->content);
    }
}