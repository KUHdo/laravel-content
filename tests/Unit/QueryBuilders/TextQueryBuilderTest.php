<?php

namespace KUHdo\Content\Tests\Unit\QueryBuilders;

use App;
use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\TestCase;

class TextQueryBuilderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\QueryBuilders\TextQueryBuilder::current
     * @return void
     */
    public function testMethodsShouldReturnTextQueryBuilderBasedOnLocalesAndOrderedByLatest()
    {
        $lang = 'de';
        config([
            'content.locales' => ['en', 'de', 'es'],
            'content.default' => 'es',
            'content.fallback' => 'en'
        ]);
        App::setLocale($lang);

        $translation = Translation::factory()->full()->create();

        $newTexts = collect(config('content.locales'))
            ->map(function ($locale) use ($translation) {
                $text = Text::factory(['lang' => $locale, 'created_at' => now()->addSecond()])->create();
                $translation->texts()->save($text);
                $translation->save();
                return $text;
            });

        collect([
            [
                'actual' => $translation->texts()->current()->first(),
                'expected' => $newTexts->firstWhere('lang', App::getLocale()),
            ],
            [
                'actual' => $translation->texts()->default()->first(),
                'expected' => $newTexts->firstWhere('lang', config('content.default'))
            ],
            [
                'actual' => $translation->texts()->fallback()->first(),
                'expected' => $newTexts->firstWhere('lang', config('content.fallback'))
            ]
        ])->each(function ($value) use ($newTexts) {
            $this->assertEquals($value['expected']->id, $value['actual']->id);
            $this->assertEquals($value['expected']->lang, $value['actual']->lang);
            $this->assertEquals($value['expected']->value, $value['actual']->value);
            $this->assertEquals($value['expected']->created_at, $value['actual']->created_at);
        });
    }
}
