<?php

namespace KUHdo\Content\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;
use KUHdo\Content\Database\Factories\TextFactory;
use KUHdo\Content\QueryBuilders\TextQueryBuilder;

class Text extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return TextFactory
     */
    protected static function newFactory(): TextFactory
    {
        return TextFactory::new();
    }

    /**
     * @inheritDoc
     *
     * @param Builder $query
     * @return TextQueryBuilder
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public function newEloquentBuilder($query): TextQueryBuilder
    {
        return new TextQueryBuilder($query);
    }

    /**
     * @return BelongsToMany
     */
    public function translations(): BelongsToMany
    {
        return $this->belongsToMany(Translation::class);
    }
}
