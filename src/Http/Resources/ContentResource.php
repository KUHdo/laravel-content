<?php

namespace KUHdo\Content\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use KUHdo\Content\Models\Content;

/** @mixin Content */
class ContentResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
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
