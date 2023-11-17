<?php

namespace KUHdo\Content\Tests\Feature\Models;

use App;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\TestCase;

class TranslationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the creation of a translation model.
     *
     * @Covers Translation::texts
     */
    public function testATranslationShouldBeCreated()
    {
        $data = collect([
            'key' => 'TestTranslation',
            'texts' => collect([
                Text::create(['lang' => 'en', 'value' => 'Hello']),
                Text::create(['lang' => 'de', 'value' => 'Hallo']),
            ]),
        ]);

        $translation = Translation::create(['key' => $data->get('key')]);
        $translation->texts()->saveMany($data->get('texts'));

        $this->assertModelExists($translation);
        $this->assertEquals($data->get('key'), $translation->key);
        $this->assertEquals($data->get('texts')->pluck('id'), $translation->texts->pluck('id'));
        $this->assertEquals($data->get('texts')->pluck('lang'), $translation->texts->pluck('lang'));
        $this->assertEquals($data->get('texts')->pluck('value'), $translation->texts->pluck('value'));
    }

    /**
     * Tests the deletion of a translation model.
     *
     * @Covers Translation::texts
     */
    public function testATranslationShouldBeDeleted()
    {
        $translation = Translation::factory()->full()->create();
        $texts = $translation->texts;
        $pivots = DB::table('text_translation')->get();

        $translation->delete();

        $this->assertDatabaseMissing('translations', $translation->toArray());

        $pivots->each(fn ($pivot) => $this->assertDatabaseMissing('text_translation', [
            'id' => $pivot->id,
            'translation_id' => $pivot->translation_id,
            'text_id' => $pivot->text_id,
        ]));

        $texts->each(fn ($text) => $this->assertDatabaseMissing('texts', $text->toArray()));
    }

    /**
     * Tests the relation to text of a translation model. The latest text should be returned.
     *
     * @Covers Translation::getCurrentTextAttribute
     */
    public function testCurrentTextShouldReturnText()
    {
        config([
            'content.locales' => ['en', 'es'],
            'content.fallback' => 'es',
        ]);

        $translation = Translation::factory()->full()->create();

        App::setLocale('de');
        $this->assertEquals($translation->currentText, $translation->texts->firstWhere('lang', config('content.fallback')));

        App::setLocale('en');
        $this->assertEquals($translation->currentText, $translation->texts->firstWhere('lang', App::getLocale()));
    }
}
