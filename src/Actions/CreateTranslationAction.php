<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\DataTransferObjects\TranslationData;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;
use Throwable;

class CreateTranslationAction
{
    /**
     * @param TranslationData $data
     * @return Translation
     * @throws Throwable
     */
    public function __invoke(TranslationData $data): Translation
    {
        $validatedTexts = collect((new ValidateRequiredTranslationTextsAction)($data->texts));

        $translation = Translation::create(['key' => $data->key]);
        $texts = $validatedTexts->map(fn(TextData $data) => Text::create($data->toArray()));
        $translation->texts()->saveMany($texts);

        return $translation;
    }
}
