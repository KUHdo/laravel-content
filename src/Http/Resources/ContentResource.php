<?php

namespace KUHdo\Content\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use KUHdo\Content\Models\Content;

/** @mixin Content */
class ContentResource extends JsonResource
{
    /**
     * Returns an array of the content model with translation and texts.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'key' => $this->translation->key,
            'lang' => $this->translation->currentText->lang,
            'text' => $this->translation->currentText->value,
            'contentable_type' => $this->contentable::class,
            'contentable_id' => $this->contentable->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
