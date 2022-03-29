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
     * @param string|null $key
     * @return Content
     * @throws Throwable
     */
    public function __invoke(Contentable $contentable, array $texts, string $key = null): Content
    {
        $translation = (new CreateTranslationAction)(
            new TranslationData(
                key: isset($key) ?: collect($texts)->firstWhere('lang', 'en')->value,
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
