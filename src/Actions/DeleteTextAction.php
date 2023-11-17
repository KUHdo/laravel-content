<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\Exceptions\MissingTranslationTextException;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;

class DeleteTextAction
{
    /**
     * Deletes a text if it's locale is not required.
     */
    public function __invoke(Translation $translation, Text $text): ?bool
    {
        $lang = $text->lang;
        $required = collect(config('content.required'))->contains($lang);
        $count = $translation->texts()->where('lang', $lang)->count() - 1;

        throw_if(
            $count == 0 && $required,
            new MissingTranslationTextException(
                "Required translation text are missing for following locale: {$lang}"
            )
        );

        return $text->delete();
    }
}
