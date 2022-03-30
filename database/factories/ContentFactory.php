<?php

namespace KUHdo\Content\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use KUHdo\Content\Models\Content;
use KUHdo\Content\Models\Translation;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'contentable_id' => $this->faker->randomDigitNotNull,
            'contentable_type' => 'TestContentableClass',
            'translation_id' => Translation::factory()->full()
        ];
    }
}
