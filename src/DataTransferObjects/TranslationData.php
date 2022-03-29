<?php

namespace KUHdo\Content\DataTransferObjects;

use Illuminate\Contracts\Support\Arrayable;

class TranslationData implements Arrayable
{
    /**
     * @param string           $key
     * @param array|TextData[] $texts
     */
    public function __construct(public string $key, public array $texts)
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return (array)$this;
    }
}
