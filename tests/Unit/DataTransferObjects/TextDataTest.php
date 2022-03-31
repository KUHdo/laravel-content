<?php

namespace KUHdo\Content\Tests\Unit\DataTransferObjects;

use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Tests\Factories\TextDataFactory;
use KUHdo\Content\Tests\TestCase;

class TextDataTest extends TestCase
{
    /**
     * @Covers \KUHdo\Content\DataTransferObjects\TextData::make
     * @return void
     */
    public function testMake()
    {
        $text = Text::factory()->make();

        $data = TextData::make($text);

        $this->assertNotNull($data->lang);
        $this->assertEquals($text->lang, $data->lang);
        $this->assertNotNull($data->value);
        $this->assertEquals($text->value, $data->value);
    }

    /**
     * @Covers \KUHdo\Content\DataTransferObjects\TextData::toArray
     * @return void
     */
    public function testToArray()
    {
        $text = TextDataFactory::new()->create();

        $array = $text->toArray();

        $this->assertIsArray($array);
        $this->assertEquals($text->lang, $array['lang']);
        $this->assertEquals($text->value, $array['value']);
    }
}
