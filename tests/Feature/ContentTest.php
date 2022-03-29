<?php

namespace KUHdo\Content\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\Facades\Content;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;

class ContentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testLocalizedTextShouldBeReturnedFromContent()
    {
        $texts = [
            new TextData(lang: 'de', value: 'Hallo'),
            new TextData(lang: 'en', value: 'Hello'),
            new TextData(lang: 'fr', value: 'Bonjour'),
            new TextData(lang: 'es', value: 'Hola'),
        ];

        $contentable = Contentable::factory()->create();
        Content::create($contentable, $texts);

        collect(config('content.locales'))->each(function ($locale) use ($contentable, $texts) {
            App::setLocale($locale);
            $expected = collect($texts)->first(fn($text) => $text->lang === $locale)?->value;
            $this->assertEquals($expected, $contentable->getContent());
        });
    }

    /**
     * @return void
     */
    public function testFallbackTextShouldBeReturnedFromContent()
    {
        $texts = [
            new TextData(lang: 'de', value: 'Hallo'),
            new TextData(lang: 'en', value: 'Hello'),
        ];

        $contentable = Contentable::factory()->create()->setContent($texts);

        App::setLocale('fr');

        $this->assertEquals('Hello', $contentable->getContent());
    }
}
