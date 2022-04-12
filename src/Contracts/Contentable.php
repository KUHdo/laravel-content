<?php

namespace KUHdo\Content\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Contentable
{
    /**
     * @return MorphOne
     */
    public function content(): MorphOne;

    /**
     * @param array|null $vars
     * @return string
     */
    public function getContent(array $vars = null): string;
}
