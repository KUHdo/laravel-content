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

    protected static function newFactory(): TextFactory
    {
        return TextFactory::new();
    }

    /**
     * @inheritDoc
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public function newEloquentBuilder($query): TextQueryBuilder
    {
        return new TextQueryBuilder($query);
    }

    public function translations(): BelongsToMany
    {
        return $this->belongsToMany(Translation::class);
    }
}
