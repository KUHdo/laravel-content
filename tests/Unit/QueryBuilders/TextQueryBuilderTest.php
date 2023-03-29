<?php

namespace KUHdo\Content\Tests\Unit\QueryBuilders;

use App;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\TestCase;

class TextQueryBuilderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the text query builder. Get the current text.
     *
     * @covers \KUHdo\Content\QueryBuilders\TextQueryBuilder::current
     */
    public function testCurrent()
    {
        config(['content.locales' => ['en', 'de', 'es']]);
        App::setLocale('de');

        $oldText = Text::factory([
            'lang' => App::getLocale()
        ])->create();
        $newText = Text::factory([
            'lang' => App::getLocale(),
            'created_at' => (new Carbon($oldText->created_at))->addSecond()
        ])->create();

        $this->assertEquals(Text::current()->first()->toArray(), $newText->toArray());
        $this->assertEquals(Text::current()->get()[Text::current()->count() - 1]->toArray(), $oldText->toArray());
    }

    /**
     * Tests the text query builder. Get the default text.
     *
     * @covers \KUHdo\Content\QueryBuilders\TextQueryBuilder::default
     */
    public function testDefault()
    {
        config([
            'content.locales' => ['en', 'de', 'es'],
            'content.default' => 'es'
        ]);

        $oldText = Text::factory([
            'lang' => config('content.default')
        ])->create();
        $newText = Text::factory([
            'lang' => config('content.default'),
            'created_at' => (new Carbon($oldText->created_at))->addSecond()
        ])->create();

        $this->assertEquals(Text::default()->first()->toArray(), $newText->toArray());
        $this->assertEquals(Text::default()->get()[Text::default()->count() - 1]->toArray(), $oldText->toArray());
    }

    /**
     * Tests the text query builder. Get the fallback text.
     *
     * @covers \KUHdo\Content\QueryBuilders\TextQueryBuilder::fallback
     */
    public function testFallback()
    {
        config([
            'content.locales' => ['en', 'de', 'es'],
            'content.fallback' => 'es'
        ]);

        $oldText = Text::factory([
            'lang' => config('content.fallback')
        ])->create();
        $newText = Text::factory([
            'lang' => config('content.fallback'),
            'created_at' => (new Carbon($oldText->created_at))->addSecond()
        ])->create();

        $this->assertEquals(Text::fallback()->first()->toArray(), $newText->toArray());
        $this->assertEquals(Text::fallback()->get()[Text::fallback()->count() - 1]->toArray(), $oldText->toArray());
    }
}
