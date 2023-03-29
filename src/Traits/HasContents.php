<?php

namespace KUHdo\Content\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use KUHdo\Content\Models\Content;

trait HasContents
{
    /**
     * Get the contents relation morph many.
     */
    public function contents(): MorphMany
    {
        return $this->morphMany(Content::class, 'contentable');
    }

    /**
     * Here the contents text will be returned. Content will be provided by slug.
     * If there is vars, like placeholder for text injection, it will be injected before text is returned.
     */
    public function getContent(string $slug, array $vars = null): string
    {
        $content = $this->contents()->whereSlug($slug)->get();

        return isset($vars) ? $content[0]->text($vars) : $content[0]->text;
    }
}
