<?php

namespace KUHdo\Content\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \KUHdo\Content\Models\Content */
class ContentCollection extends ResourceCollection
{
    /**
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
