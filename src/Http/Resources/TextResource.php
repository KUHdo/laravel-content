<?php

namespace KUHdo\Content\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use KUHdo\Content\Models\Text;

/** @mixin Text */
class TextResource extends JsonResource
{
    /**
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public function toArray($request)
    {
        return isset($this->resource) ? [
            'id' => $this->id,
            'lang' => $this->lang,
            'value' => $this->value,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ] : [];
    }
}
