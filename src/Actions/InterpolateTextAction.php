<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\Models\Text;
use Str;

class InterpolateTextAction
{
    /**
     * @param Text  $text
     * @param array $vars
     * @return Text
     */
    public function __invoke(Text $text, array $vars): Text
    {
        return $text->replicate()->fill([
            'value' => collect($vars)->reduce(
                fn($textValue, $value, $key) => Str::replace("{".$key."}", $value, $textValue),
                $text->value
            )
        ]);
    }
}
