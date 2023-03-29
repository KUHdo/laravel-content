<?php

namespace KUHdo\Content\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use KUHdo\Content\Database\Factories\TextFactory;
use KUHdo\Content\QueryBuilders\TextQueryBuilder;

class Text extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Returns the Text Factory.
     */
    protected static function newFactory(): TextFactory
    {
        return TextFactory::new();
    }

    /**
     * Returns the query builder.
     */
    public function newEloquentBuilder($query): TextQueryBuilder
    {
        return new TextQueryBuilder($query);
    }

    /**
     * A text belongs to translations.
     */
    public function translations(): BelongsToMany
    {
        return $this->belongsToMany(Translation::class);
    }
}
