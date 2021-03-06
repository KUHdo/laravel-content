<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\UpdateTextAction;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\TestCase;

class UpdateTextActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @Covers \KUHdo\Content\Actions\UpdateTextAction
     * @return void
     */
    public function testTextShouldBeUpdated()
    {
        config(['content.locales' => ['de', 'en', 'es']]);
        $translation = Translation::factory()->full()->create();
        $text = $translation->texts->firstWhere('lang', 'de');

        $result = (new UpdateTextAction)($translation, $text, ['value' => 'test']);

        $this->assertModelExists($text);
        $this->assertModelExists($result);
        $this->assertNotEquals($text, $result);
    }
}
