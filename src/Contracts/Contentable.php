<?php

namespace KUHdo\Content\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Contentable
{
    /**
     * @return MorphMany
     */
    public function contents(): MorphMany;

    /**
     * @param array|null $vars
     * @return string
     */
    public function getContent(string $slug, array $vars = null): string;
}
