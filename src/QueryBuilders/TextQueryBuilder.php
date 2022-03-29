<?php

namespace KUHdo\Content\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class TextQueryBuilder extends Builder
{
    /**
     * @return Builder
     */
    public function current(): Builder
    {
        return $this->where('lang', App::currentLocale())->latest();
    }

    /**
     * @return Builder
     */
    public function default(): Builder
    {
        return $this->where('lang', config('content.default'))->latest();
    }

    /**
     * @return Builder
     */
    public function fallback(): Builder
    {
        return $this->where('lang', config('content.fallback'))->latest();
    }
}
