<?php

namespace KUHdo\Content\Actions;

use Illuminate\Support\Str;
use KUHdo\Content\Models\Text;

class InterpolateTextAction
{
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
