<?php

namespace KUHdo\Content\Traits;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use KUHdo\Content\Actions\CreateContentAction;
use KUHdo\Content\DataTransferObjects\TextData;
use KUHdo\Content\DataTransferObjects\TranslationData;
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
     * @param array|null $vars
     * @return string
     */
    public function getContent(array $vars = null): string
    {
        return isset($vars) ? $this->content->text($vars) : $this->content->text;
    }

    /**
     * @param TextData[]  $texts
     * @param string|null $key
     * @return $this
     * @throws Throwable
     */
    public function setContent(array $texts, ?string $key = null): static
    {
        (new CreateContentAction)($this, new TranslationData(key: $key, texts: $texts));

        return $this;
    }
}
