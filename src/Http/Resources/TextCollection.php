<?php

namespace KUHdo\Content\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \KUHdo\Content\Models\Text */
class TextCollection extends ResourceCollection
{
    /**
     * Returns an array of the text collection.
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
