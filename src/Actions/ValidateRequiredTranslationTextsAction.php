<?php

namespace KUHdo\Content\Actions;

use Illuminate\Database\Eloquent\Collection;
use KUHdo\Content\Exceptions\MissingTranslationTextException;
use KUHdo\Content\Models\Text;
use Throwable;

class ValidateRequiredTranslationTextsAction
{
    /**
     * @param Collection|Text $texts
     * @return Collection
     * @throws Throwable
     */
    public function __invoke(Collection|Text $texts): Collection
    {
        if ($texts instanceof Text) {
            $texts = Collection::make($texts);
        }

        $missing = collect(config('content.required'))
            ->filter(fn($locale) => !$texts->contains('lang', $locale));

        throw_if(
            $missing->isNotEmpty(),
            new MissingTranslationTextException(
                "Required translation texts are missing for following locales: {$missing->values()}"
            )
        );

        return $texts;
    }
}
