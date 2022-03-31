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
     * @Covers \KUHdo\Content\Models\Translation::newFactory
     * @return void
     */
    public function testNewFactory()
    {
        $this->assertInstanceOf(TranslationFactory::class, Translation::factory());
    }

    /**
     * @Covers \KUHdo\Content\Models\Translation::newEloquentBuilder
     * @return void
     */
    public function testNewEloquentBuilder()
    {
        $this->assertInstanceOf(TranslationQueryBuilder::class, Translation::query());
    }

    /**
     * @Covers \KUHdo\Content\Models\Translation::texts
     * @return void
     */
    public function testTexts()
    {
        $this->assertInstanceOf(Text::class, (new Translation)->texts()->getModel());
    }

    /**
     * @Covers \KUHdo\Content\Models\Translation::contents
     * @return void
     */
    public function testContents()
    {
        $this->assertInstanceOf(Content::class, (new Translation)->contents()->getModel());
    }

    /**
     * @Covers \KUHdo\Content\Models\Translation::getCurrentTextAttribute
     * @return void
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
