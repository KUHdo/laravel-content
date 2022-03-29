<?php

namespace KUHdo\Content\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use KUHdo\Content\DataTransferObjects\TextData;

interface Contentable
{
    /**
     * @return MorphOne
     */
    public function content(): MorphOne;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @param TextData[] $texts
     * @return $this
     */
    public function setContent(array $texts): static;
}
