<?php

namespace KUHdo\Content\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class ContentQueryBuilder extends Builder
{
    /**
     * Since a model can have more than one content, it's important to be able to search for the slug.
     * Which is stored as 'key' in translations. It will return the content which is needed by the slug.
     */
    public function whereSlug(string $slug): Builder
    {
        return $this->whereHas('translation', fn ($query) => $query->where('key', $slug));
    }
}
