<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\Contracts\Contentable;
use KUHdo\Content\DataTransferObjects\TranslationData;
use KUHdo\Content\Models\Content;
use Throwable;

class CreateContentAction
{
    /**
     * @param Contentable     $contentable
     * @param TranslationData $translationData
     * @return Content
     * @throws Throwable
     */
    public function __invoke(Contentable $contentable, TranslationData $translationData): Content
    {
        $translation = (new CreateTranslationAction)($translationData);
        $content = new Content();
        $content->translation()->associate($translation);
        $content->contentable()->associate($contentable);
        $content->save();

        return $content;
    }
}
