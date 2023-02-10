<?php

namespace KUHdo\Content\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Contentable
{
    public function content(): MorphOne;

    /**
     * @param array|null $vars
     * @return string
     */
    public function getContent(array $vars = null): string;
}
