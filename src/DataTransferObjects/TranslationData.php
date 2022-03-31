<?php

namespace KUHdo\Content\DataTransferObjects;

use Illuminate\Contracts\Support\Arrayable;
use KUHdo\Content\Models\Translation;

class TranslationData implements Arrayable
{
    /**
     * @param string|null $key
     * @param TextData[]  $texts
     */
    public function __construct(public ?string $key = null, public ?array $texts = null)
    {
    }

    /**
     * @param Translation $translation
     * @return TranslationData
     */
    public static function make(Translation $translation): TranslationData
    {
        return new self(key: $translation->key, texts: $translation->texts);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return (array)$this;
    }
}
