<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\DataTransferObjects\TranslationData;

class InterpolateTranslationAction
{
    /**
     * @param TranslationData $translation
     * @param array           $vars
     * @return TranslationData
     */
    public function __invoke(TranslationData $translation, array $vars): TranslationData
    {
        $translation->texts = collect($translation->texts)
            ->map(fn($text) => (new InterpolateTextAction)($text, $vars))
            ->all();

        return $translation;
    }
}
