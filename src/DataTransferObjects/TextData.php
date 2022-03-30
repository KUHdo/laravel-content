<?php

namespace KUHdo\Content\DataTransferObjects;

use Illuminate\Contracts\Support\Arrayable;
use KUHdo\Content\Models\Text;

class TextData implements Arrayable
{
    /**
     * @param string $lang
     * @param string $value
     */
    public function __construct(public string $lang, public string $value)
    {
    }

    /**
     * @param Text $text
     * @return TextData
     */
    public static function make(Text $text): TextData
    {
        return new self(lang: $text->lang, value: $text->value);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return (array)$this;
    }
}
