<?php

namespace KUHdo\Content\Actions;

use KUHdo\Content\Contracts\Contentable;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Models\Translation;

class CreateContentAction
{
    /**
     * A new content gets created. The contentable model, with translation needs to be provided.
     */
    public function __invoke(Contentable $contentable, Translation $translation): Content
    {
        $content = new Content();
        $content->translation()->associate($translation);
        $content->contentable()->associate($contentable);
        $content->save();

        return $content;
    }
}
