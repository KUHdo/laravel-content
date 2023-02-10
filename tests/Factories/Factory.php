<?php

namespace KUHdo\Content\Tests\Factories;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;

abstract class Factory
{
    use WithFaker;

    public function __construct()
    {
        $this->setUpFaker();
    }

    public static function new(): self
    {
        return new static();
    }

    abstract public function create(array $extra = []): mixed;

    public function times(int $times, array $extra = []): Collection
    {
        return collect()
            ->times($times)
            ->map(fn() => $this->create($extra));
    }
}
