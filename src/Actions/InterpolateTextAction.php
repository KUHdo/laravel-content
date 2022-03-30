<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\DataTransferObjects\TextData;
use Str;

class InterpolateTextAction
{
    /**
     * @param TextData $text
     * @param array    $vars
     * @return TextData
     */
    public function __invoke(TextData $text, array $vars): TextData
    {
        $text->value = collect($vars)->reduce(
            fn($textValue, $value, $key) => Str::replace("{".$key."}", $value, $textValue),
            $text->value
        );
        return $text;
    }
}
