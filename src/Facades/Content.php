<?php

namespace KUHdo\Content\Facades;

use Illuminate\Support\Facades\Facade;

class Content extends Facade
{
    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'content';
    }
}
