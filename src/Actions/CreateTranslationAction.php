<?php

namespace KUHdo\Content\Actions;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Content\Models\Translation;

class CreateTranslationAction
{
    /**
     * Saves the translation with its key, and adds the texts to it.
     */
    public function __invoke(Collection $texts, string $key = null): Translation
    {
        $validatedTexts = (new ValidateRequiredTranslationTextsAction)($texts);

        $translation = new Translation;
        $translation->key = $key ?: $validatedTexts->firstWhere('lang', config('content.default'))->value;
        $translation->save();
        $translation->texts()->saveMany($validatedTexts);

        return $translation;
    }
}
