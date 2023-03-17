<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\DeleteTextAction;
use KUHdo\Content\Exceptions\MissingTranslationTextException;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\TestCase;
use Throwable;

class DeleteTextActionTest extends TestCase
{
    use RefreshDatabase;

    protected Translation $translation;

    /**
     * Setup test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        config([
            'content.locales' => ['de', 'en', 'es'],
            'content.required' => ['de', 'en']
        ]);

        $this->translation = Translation::factory()->full()->create();
    }

    /**
     * Tests if a text can be deleted.
     *
     * @Covers \KUHdo\Content\Actions\DeleteTextAction
     *
     * @throws Throwable
     */
    public function testTextShouldBeDeleted()
    {
        $text = $this->translation->texts()->where('lang', 'es')->first();

        $result = (new DeleteTextAction)($this->translation, $text);

        $this->assertTrue($result);
        $this->assertModelMissing($text);
    }

    /**
     * Tests that required text should not be deleted.
     *
     * @Covers \KUHdo\Content\Actions\DeleteTextAction
     *
     * @throws Throwable
     */
    public function testRequiredTextShouldNotBeDeleted()
    {
        $text = $this->translation->texts()->where('lang', 'de')->first();

        $this->expectException(MissingTranslationTextException::class);

        (new DeleteTextAction)($this->translation, $text);
    }

    /**
     * Test that additional required text should be possible to delete.
     *
     * @Covers \KUHdo\Content\Actions\DeleteTextAction
     *
     * @throws Throwable
     */
    public function testAdditionalRequiredTextShouldBeDeleted()
    {
        $text = Text::factory(['lang' => 'de'])->create();
        $this->translation->texts()->save($text);

        $result = (new DeleteTextAction)($this->translation, $text);

        $this->assertTrue($result);
        $this->assertModelMissing($text);
    }
}
