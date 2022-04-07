<?php

namespace KUHdo\Content\Actions;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Content\Models\Translation;
use Throwable;

class CreateTranslationAction
{
    /**
     * @param Collection  $texts
     * @param string|null $key
     * @return Translation
     * @throws Throwable
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
