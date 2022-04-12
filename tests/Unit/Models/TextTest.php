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
     * @Covers \KUHdo\Content\Models\Text::newFactory
     * @return void
     */
    public function testNewFactory()
    {
        $this->assertInstanceOf(TextFactory::class, Text::factory());
    }

    /**
     * @Covers \KUHdo\Content\Models\Text::newEloquentBuilder
     * @return void
     */
    public function testNewEloquentBuilder()
    {
        $this->assertInstanceOf(TextQueryBuilder::class, Text::query());
    }

    /**
     * @Covers \KUHdo\Content\Models\Text::translations
     * @return void
     */
    public function testTranslations()
    {
        $this->assertInstanceOf(Translation::class, (new Text)->translations()->getModel());
    }
}
