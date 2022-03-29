<?php

namespace KUHdo\Content\Traits;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use KUHdo\Content\Actions\CreateContentAction;
use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\Models\Content;
use Throwable;

trait HasContent
{
    /**
     * @return MorphOne
     */
    public function content(): MorphOne
    {
        return $this->morphOne(Content::class, 'contentable');
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content->text;
    }

    /**
     * @param TextData[] $texts
     * @return $this
     * @throws Throwable
     */
    public function setContent(array $texts): static
    {
        (new CreateContentAction)($this, $texts);

        return $this;
    }
}
