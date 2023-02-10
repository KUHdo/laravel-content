<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;

class UpdateTextAction
{
    public function __invoke(Translation $translation, Text $text, array $data): Text
    {
        $new = Text::create($data + $text->only(['lang', 'value']));
        $translation->texts()->save($new);
        $translation->refresh();

        return $translation->texts->find($new->id);
    }
}
