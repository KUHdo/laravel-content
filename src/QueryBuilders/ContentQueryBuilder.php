<?php

namespace KUHdo\Content\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class ContentQueryBuilder extends Builder
{
    /**
     * @return Builder
     */
    public function whereSlug(string $slug): Builder
    {
        return $this->whereHas('translation', fn ($query) => $query->where('key', $slug));
    }
}
