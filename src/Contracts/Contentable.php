<?php

namespace KUHdo\Content\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Contentable
{
    /**
     * Defines the morph many relation contents.
     */
    public function contents(): MorphMany;

    /**
     * Here the contents text will be returned. Content will be provided by slug.
     * If there is vars, like placeholder for text injection, it will be injected before text is returned.
     */
    public function getContent(string $slug, array $vars = null): string;
}
