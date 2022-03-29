<?php

namespace KUHdo\Content;

use KUHdo\Content\Actions\CreateContentAction;
use KUHdo\Content\Contracts\Contentable;
use KUHdo\Content\DataTransferObjects\TextData;
use Throwable;

class Content
{
    /**
     * @param Contentable $contentable
     * @param TextData[]  $texts
     * @param string|null $key
     * @return Models\Content
     * @throws Throwable
     */
    public function create(Contentable $contentable, array $texts, string $key = null): Models\Content
    {
        return (new CreateContentAction)($contentable, $texts, $key);
    }
}
