<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\Models\Translation;

class InterpolateTranslationAction
{
    public function __invoke(Translation $translation, array $vars): Translation
    {
        return $translation->replicate()->fill([
            'texts' => $translation->texts
                ->map(fn($text) => (new InterpolateTextAction)($text, $vars))
        ]);
    }
}
