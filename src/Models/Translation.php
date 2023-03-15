<?php

namespace KUHdo\Content\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * Returns the query builder.
     */
    public function newEloquentBuilder($query): TranslationQueryBuilder
    {
        return new TranslationQueryBuilder($query);
    }

    /**
     * A translations has can have many texts.
     */
    public function texts(): BelongsToMany
    {
        return $this->belongsToMany(Text::Class);
    }

    /**
     * Returns the query builder.
     */
    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Get the current text of a translation.
     */
    public function getCurrentTextAttribute(): Text
    {
        return $this->texts()->current()->first() ?: $this->texts()->fallback()->first();
    }
}
