<?php

namespace KUHdo\Content\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\Actions\CreateTranslationAction;
use KUHdo\Content\DataTransferObjects\TranslationData;
use KUHdo\Content\Tests\Factories\TextDataFactory;
use KUHdo\Content\Tests\Factories\TranslationDataFactory;
use KUHdo\Content\Tests\TestCase;
use Throwable;

class CreateTranslationActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @covers \KUHdo\Content\Actions\CreateTranslationAction
     * @return void
     * @throws Throwable
     */
    public function testTranslationShouldBeCreated()
    {
        $translationData = TranslationDataFactory::new()->create();

        $translation = (new CreateTranslationAction)($translationData);

        $this->assertModelExists($translation);
    }

    /**
     * @covers \KUHdo\Content\Actions\CreateTranslationAction
     * @return void
     * @throws Throwable
     */
    public function testTranslationShouldHaveKeyBasedOnDefaultLocaleText()
    {
        $default = 'de';
        config(['content.default' => $default]);

        $textData = [
            TextDataFactory::new()->create(['lang' => 'de']),
            TextDataFactory::new()->create(['lang' => 'en']),
        ];
        $translationData = new TranslationData(key: null, texts: $textData);

        $translation = (new CreateTranslationAction)($translationData);

        $this->assertEquals(
            $translation->key,
            collect($textData)->where('lang', $default)->first()->value
        );
    }
}
