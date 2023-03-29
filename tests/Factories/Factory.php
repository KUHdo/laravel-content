<?php

namespace KUHdo\Content\Tests\Factories;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;

abstract class Factory
{
    use WithFaker;

    /**
     * Test factory set up faker constructor.
     */
    public function __construct()
    {
        $this->setUpFaker();
    }

    /**
     * Test factory create new instance of factory self.
     */
    public static function new(): self
    {
        return new static();
    }

    /**
     * Test factory create.
     */
    abstract public function create(array $extra = []): mixed;

    /**
     * Factory times.
     */
    public function times(int $times, array $extra = []): Collection
    {
        return collect()
            ->times($times)
            ->map(fn() => $this->create($extra));
    }
}
