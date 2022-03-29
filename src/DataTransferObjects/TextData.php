<?php

namespace KUHdo\Content\DataTransferObjects;

use Illuminate\Contracts\Support\Arrayable;

class TextData implements Arrayable
{
    /**
     * @param string $lang
     * @param string $value
     */
    public function __construct(public string $lang, public string $value)
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
