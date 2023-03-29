<?php

namespace KUHdo\Content\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \KUHdo\Content\Models\Content */
class ContentCollection extends ResourceCollection
{
    /**
     * Returns an array of the content collection.
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
