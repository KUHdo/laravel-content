<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\Contracts\Contentable;
use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\DataTransferObjects\TranslationData;
use KUHdo\Content\Models\Content;
use Throwable;

class CreateContentAction
{
    /**
     * @param Contentable $contentable
     * @param TextData[]  $texts
     * @return Content
     * @throws Throwable
     */
    public function __invoke(Contentable $contentable, array $texts): Content
    {
        $translation = (new CreateTranslationAction)(
            new TranslationData(
                key: collect($texts)->firstWhere('lang', 'en')->value,
                texts: $texts
            )
        );

        $content = new Content();
        $content->translation()->associate($translation);
        $content->contentable()->associate($contentable);
        $content->save();

        return $content;
    }
}
