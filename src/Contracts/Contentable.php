<?php

namespace KUHdo\Content\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Contentable
{
    public function content(): MorphOne;

    public function getContent(array $vars = null): string;
}
