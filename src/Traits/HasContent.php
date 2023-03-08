<?php

namespace KUHdo\Content\Traits;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use KUHdo\Content\Models\Content;

trait HasContent
{
    public function content(): MorphOne
    {
        return $this->morphOne(Content::class, 'contentable');
    }

    public function getContent(array $vars = null): string
    {
        return isset($vars) ? $this->content->text($vars) : $this->content->text;
    }
}
