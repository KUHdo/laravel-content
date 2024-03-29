<?php

namespace KUHdo\Content\Actions;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Content\Exceptions\MissingTranslationTextException;
use KUHdo\Content\Models\Text;

class ValidateRequiredTranslationTextsAction
{
    /**
     * Checks if translation texts for required locales are provided.
     */
    public function __invoke(Collection|Text $texts): Collection
    {
        if ($texts instanceof Text) {
            $texts = Collection::make($texts);
        }

        $missing = collect(config('content.required'))
            ->filter(fn ($locale) => ! $texts->contains('lang', $locale));

        throw_if(
            $missing->isNotEmpty(),
            new MissingTranslationTextException(
                "Required translation texts are missing for following locales: {$missing->values()}"
            )
        );

        return $texts;
    }
}
