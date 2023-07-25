<?php

namespace KUHdo\Content\Tests\Unit\Models;

use KUHdo\Content\Database\Factories\TextFactory;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\QueryBuilders\TextQueryBuilder;
use KUHdo\Content\Tests\TestCase;

class TextTest extends TestCase
{
    /**
     * Tests the text model new factory.
     *
     * @Covers Text::newFactory
     */
    public function testNewFactory()
    {
        $this->assertInstanceOf(TextFactory::class, Text::factory());
    }

    /**
     * Tests the text model new eloquent builder.
     *
     * @Covers Text::newEloquentBuilder
     */
    public function testNewEloquentBuilder()
    {
        $this->assertInstanceOf(TextQueryBuilder::class, Text::query());
    }

    /**
     * Tests the text model relation to translation.
     *
     * @Covers Text::translations
     */
    public function testTranslations()
    {
        $this->assertInstanceOf(Translation::class, (new Text)->translations()->getModel());
    }
}
