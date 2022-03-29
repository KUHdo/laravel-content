<?php

namespace KUHdo\Content\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use KUHdo\Content\Models\Text;

class TextFactory extends Factory
{
    protected $model = Text::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->sentence,
            'lang' => Arr::random(config('content.locales')),
        ];
    }
}
