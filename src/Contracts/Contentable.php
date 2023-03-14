<?php

namespace KUHdo\Content\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Contentable
{
<<<<<<< Updated upstream
    public function content(): MorphOne;


    public function getContent(array $vars = null): string;
=======
    /**
     * @return MorphMany
     */
    public function contents(): MorphMany;

    /**
     * @param array|null $vars
     * @return string
     */
    public function getContent(string $slug, array $vars = null): string;
>>>>>>> Stashed changes
}
