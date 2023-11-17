<?php

namespace KUHdo\Content\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Models\Translation;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'translation_id' => Translation::factory()->full(),
        ];
    }
}
