<?php

namespace KUHdo\Content\Tests\Fixtures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use KUHdo\Content\Contracts\Contentable as ContentableInterface;
use KUHdo\Content\Traits\HasContents;

class Contentable extends Model implements ContentableInterface
{
    use HasFactory;
    use HasContents;

    /**
     * Returns contentable factory.
     */
    protected static function newFactory(): ContentableFactory
    {
        return ContentableFactory::new();
    }
}
