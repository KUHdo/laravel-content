<?php

namespace KUHdo\Content\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class TextQueryBuilder extends Builder
{
    /**
     * Returns the latest text which has Apps locale.
     */
    public function current(): Builder
    {
        return $this->where('lang', App::currentLocale())->latest();
    }

    /**
     * Returns the latest text which is the default language.
     */
    public function default(): Builder
    {
        return $this->where('lang', config('content.default'))->latest();
    }

    /**
     * Returns the latest text which is the default language.
     */
    public function fallback(): Builder
    {
        return $this->where('lang', config('content.fallback'))->latest();
    }
}
