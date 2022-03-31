<?php

namespace KUHdo\Content\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\Facades\Content;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;
use Str;

class ContentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testLocalizedTextShouldBeReturnedFromContent()
    {
        $texts = [
            new TextData(lang: 'de', value: 'Hallo {VAR}'),
            new TextData(lang: 'en', value: 'Hello {VAR}'),
            new TextData(lang: 'fr', value: 'Bonjour {VAR}'),
            new TextData(lang: 'es', value: 'Hola {VAR}'),
        ];

        $contentable = Contentable::factory()->create();
        Content::for($contentable)->texts($texts)->save();

        collect(config('content.locales'))->each(function ($locale) use ($contentable, $texts) {
            App::setLocale($locale);
            $expected = collect($texts)->first(fn($text) => $text->lang === $locale)?->value;
            $this->assertEquals(
                $expected,
                $contentable->getContent()
            );
            $this->assertEquals(
                Str::replace("{VAR}", "World", $expected),
                $contentable->getContent(['VAR' => 'World'])
            );
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

        $contentable = Contentable::factory()->create();
        Content::for($contentable)->texts($texts)->save();

        App::setLocale('fr');

        $this->assertEquals('Hello', $contentable->getContent());
    }
}
