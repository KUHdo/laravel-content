<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\Exceptions\MissingTranslationTextException;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;
use Throwable;

class DeleteTextAction
{
    /**
     * @throws Throwable
     */
    public function __invoke(Translation $translation, Text $text): null| bool
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
