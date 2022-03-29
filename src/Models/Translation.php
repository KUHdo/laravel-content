<?php

namespace KUHdo\Content\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use KUHdo\Content\Database\Factories\TranslationFactory;
use KUHdo\Content\QueryBuilders\TranslationQueryBuilder;

class Translation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return TranslationFactory
     */
    protected static function newFactory(): TranslationFactory
    {
        return TranslationFactory::new();
    }

    /**
     * @inheritDoc
     *
     * @param Builder $query
     * @return TranslationQueryBuilder
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public function newEloquentBuilder($query): TranslationQueryBuilder
    {
        return new TranslationQueryBuilder($query);
    }

    /**
     * @return BelongsToMany
     */
    public function texts(): BelongsToMany
    {
        return $this->belongsToMany(Text::Class);
    }

    /**
     * @return HasMany
     */
    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    /**
     * @return Text
     */
    public function getCurrentTextAttribute(): Text
    {
        return $this->texts()->current()->first() ?: $this->texts()->fallback()->first();
    }
}
