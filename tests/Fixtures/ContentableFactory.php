<?php

namespace KUHdo\Content\Tests\Fixtures;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContentableFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Contentable::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [];
    }
}
