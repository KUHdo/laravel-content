<?php

namespace KUHdo\Content\Tests\Unit\Models;

use App;
use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Database\Factories\TranslationFactory;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\QueryBuilders\TranslationQueryBuilder;
use KUHdo\Content\Tests\TestCase;

class TranslationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the translation model new factory.
     *
     * @Covers Translation::newFactory
     */
    public function testNewFactory()
    {
        $this->assertInstanceOf(TranslationFactory::class, Translation::factory());
    }

    /**
     * Tests the translation model new eloquent builder.
     *
     * @Covers Translation::newEloquentBuilder
     */
    public function testNewEloquentBuilder()
    {
        $this->assertInstanceOf(TranslationQueryBuilder::class, Translation::query());
    }

    /**
     * Tests the translation model relation to texts.
     *
     * @Covers Translation::texts
     */
    public function testTexts()
    {
        $this->assertInstanceOf(Text::class, (new Translation)->texts()->getModel());
    }

    /**
     * Tests the translation model relation to contents.
     *
     * @Covers Translation::contents
     */
    public function testContents()
    {
        $this->assertInstanceOf(Content::class, (new Translation)->contents()->getModel());
    }

    /**
     * Tests the translation model get the current text attribute.
     *
     * @Covers Translation::getCurrentTextAttribute
     */
    public function testGetCurrentTextAttribute()
    {
        config([
            'content.locales' => ['en', 'de'],
            'content.fallback' => 'de'
        ]);

        $translation = Translation::factory()->full()->create();

        $this->assertInstanceOf(Text::class, $translation->currentText);

        App::setLocale('en');
        $this->assertEquals('en', $translation->currentText->lang);

        App::setLocale('es');
        $this->assertEquals('de', $translation->currentText->lang);
    }
}
