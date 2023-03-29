<?php

namespace KUHdo\Content\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use KUHdo\Content\Actions\InterpolateTextAction;
use KUHdo\Content\Database\Factories\ContentFactory;
use KUHdo\Content\QueryBuilders\ContentQueryBuilder;

class Content extends Model
{
    use HasFactory;

    public $guarded = [];

    /**
     * Returns the Content Factory.
     */
    protected static function newFactory(): ContentFactory
    {
        return ContentFactory::new();
    }

    /**
     * Returns the query builder.
     */
    public function newEloquentBuilder($query): ContentQueryBuilder
    {
        return new ContentQueryBuilder($query);
    }

    /**
     * Relation to translation.
     */
    public function translation(): BelongsTo
    {
        return $this->belongsTo(Translation::class);
    }

    /**
     * The contentable is a morph to many relation.
     */
    public function contentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * get the latest Text of the content.
     */
    public function getTextAttribute(): string
    {
        return $this->translation()->first()->currentText->value;
    }

    /**
     * This method is called in the HasContent Traits. Search and replace style.
     */
    public function text(array $vars): string
    {
        return (new InterpolateTextAction)($this->translation()->first()->currentText, $vars)->value;
    }
}
