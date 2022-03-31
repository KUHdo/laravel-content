<?php

namespace KUHdo\Content\Tests\Unit\DataTransferObjects;

use Illuminate\Foundation\Testing\RefreshDatabase;
use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\DataTransferObjects\TranslationData;
use KUHdo\Content\Models\Translation;
use KUHdo\Content\Tests\Factories\TranslationDataFactory;
use KUHdo\Content\Tests\TestCase;

class TranslationDataTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @Covers \KUHdo\Content\DataTransferObjects\TranslationData::make
     * @return void
     */
    public function testMake()
    {
        $translation = Translation::factory()->full()->create();

        $data = TranslationData::make($translation);

        $this->assertNotNull($data->key);
        $this->assertEquals($translation->key, $data->key);
        $this->assertNotNull($data->texts);
        $this->assertEquals($translation->texts->map(fn($text) => TextData::make($text))->all(), $data->texts);
    }

    /**
     * @Covers \KUHdo\Content\DataTransferObjects\TranslationData::toArray
     * @return void
     */
    public function testToArray()
    {
        $translation = TranslationDataFactory::new()->create();

        $array = $translation->toArray();

        $this->assertIsArray($array);
        $this->assertEquals($translation->key, $array['key']);
        $this->assertEquals($translation->texts, $array['texts']);
    }
}
