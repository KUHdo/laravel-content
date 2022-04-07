<?php

namespace KUHdo\Content\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Query\Builder;
use KUHdo\Content\Actions\InterpolateTextAction;
use KUHdo\Content\Database\Factories\ContentFactory;
use KUHdo\Content\QueryBuilders\ContentQueryBuilder;

class Content extends Model
{
    use HasFactory;

    /**
     * @return ContentFactory
     */
    protected static function newFactory(): ContentFactory
    {
        return ContentFactory::new();
    }

    /**
     * @inheritDoc
     *
     * @param Builder $query
     * @return ContentQueryBuilder
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public function newEloquentBuilder($query): ContentQueryBuilder
    {
        return new ContentQueryBuilder($query);
    }

    /**
     * @return BelongsTo
     */
    public function translation(): BelongsTo
    {
        return $this->belongsTo(Translation::class);
    }

    /**
     * @return MorphTo
     */
    public function contentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function getTextAttribute(): string
    {
        return $this->translation()->first()->currentText->value;
    }

    /**
     * @param array $vars
     * @return string
     */
    public function text(array $vars): string
    {
        return (new InterpolateTextAction)($this->translation()->first()->currentText, $vars)->value;
    }
}
