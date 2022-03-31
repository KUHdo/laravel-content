<?php

namespace KUHdo\Content\Tests\Factories;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;

abstract class Factory
{
    use WithFaker;

    /**
     *
     */
    public function __construct()
    {
        $this->setUpFaker();
    }

    /**
     * @return static
     */
    public static function new(): self
    {
        return new static();
    }

    /**
     * @param array $extra
     * @return mixed
     */
    abstract public function create(array $extra = []): mixed;

    /**
     * @param integer $times
     * @param array   $extra
     * @return Collection
     */
    public function times(int $times, array $extra = []): Collection
    {
        return collect()
            ->times($times)
            ->map(fn() => $this->create($extra));
    }
}
