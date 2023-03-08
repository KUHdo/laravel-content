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

    
    protected $guarded = [];

    protected static function newFactory(): TranslationFactory
    {
        return TranslationFactory::new();
    }

    /**
     * @inheritDoc
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public function newEloquentBuilder($query): TranslationQueryBuilder
    {
        return new TranslationQueryBuilder($query);
    }

    public function texts(): BelongsToMany
    {
        return $this->belongsToMany(Text::Class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    public function getCurrentTextAttribute(): Text
    {
        return $this->texts()->current()->first() ?: $this->texts()->fallback()->first();
    }
}
