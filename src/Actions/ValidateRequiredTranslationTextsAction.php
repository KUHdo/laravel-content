<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\Exceptions\MissingTranslationTextException;
use Throwable;

class ValidateRequiredTranslationTextsAction
{
    /**
     * @param TextData[] $texts
     * @return TextData[]
     * @throws Throwable
     */
    public function __invoke(array $texts): array
    {
        $missing = collect(config('content.required'))
            ->filter(fn($lang) => !collect($texts)->contains(fn($value) => $value->lang === $lang));


        throw_if(
            $missing->isNotEmpty(),
            new MissingTranslationTextException(
                "Required translation texts are missing for following locales: {$missing->values()}"
            )
        );

        return $texts;
    }
}
