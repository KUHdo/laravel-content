<?php

namespace KUHdo\Content\Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use KUHdo\Content\Facades\Content;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\Fixtures\Contentable;
use KUHdo\Content\Tests\TestCase;
use Str;

class ContentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests localized text should be returned from content.
     */
    public function testLocalizedTextShouldBeReturnedFromContent()
    {
        $texts = new Collection([
            new Text(['lang' => 'de', 'value' => 'Hallo {VAR}']),
            new Text(['lang' => 'en', 'value' => 'Hello {VAR}']),
            new Text(['lang' => 'fr', 'value' => 'Bonjour {VAR}']),
            new Text(['lang' => 'es', 'value' => 'Hola {VAR}']),
        ]);
        $key = 'Test';

        $contentable = Contentable::factory()->create();

        Content::for($contentable)->key($key)->texts($texts)->save();

        collect(config('content.locales'))->each(function ($locale) use ($key, $contentable, $texts) {
            App::setLocale($locale);
            $expected = collect($texts)->first(fn ($text) => $text->lang === $locale)?->value;
            $this->assertEquals(
                $expected,
                $contentable->getContent($key)
            );
            $this->assertEquals(
                Str::replace('{VAR}', 'World', $expected),
                $contentable->getContent($key, ['VAR' => 'World'])
            );
        });
    }

    /**
     * Tests fallback text should be returned from content.
     */
    public function testFallbackTextShouldBeReturnedFromContent()
    {
        $texts = new Collection([
            new Text(['lang' => 'de', 'value' => 'Hallo']),
            new Text(['lang' => 'en', 'value' => 'Hello']),
        ]);
        $key = ('Test');

        $contentable = Contentable::factory()->create();
        Content::for($contentable)->key($key)->texts($texts)->save();

        App::setLocale('fr');

        $this->assertEquals('Hello', $contentable->getContent($key));
    }
}
