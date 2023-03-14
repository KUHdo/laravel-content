<?php

namespace KUHdo\Content\Models;

use Illuminate\Database\Eloquent\Collection;
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


    public $guarded = [];

    protected static function newFactory(): ContentFactory
    {
        return ContentFactory::new();
    }

    /**
     * @inheritDoc
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public function newEloquentBuilder($query): ContentQueryBuilder
    {
        return new ContentQueryBuilder($query);
    }

<<<<<<< Updated upstream
=======
    /**
     *
     * @return BelongsTo
     */
>>>>>>> Stashed changes
    public function translation(): BelongsTo
    {
        return $this->belongsTo(Translation::class);
    }

    public function contentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getTextAttribute(): string
    {
        return $this->translation()->first()->currentText->value;
    }

<<<<<<< Updated upstream
=======
    /**
     * This method is called in the HasContent Traits. search and replace style
     *
     * @param array $vars
     * @return string
     */
>>>>>>> Stashed changes
    public function text(array $vars): string
    {
        return (new InterpolateTextAction)($this->translation()->first()->currentText, $vars)->value;
    }
}
