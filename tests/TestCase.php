<?php

namespace KUHdo\Content\Tests;

use Illuminate\Foundation\Application;
use KUHdo\Content\ContentServiceProvider;
use KUHdo\Content\Tests\Fixtures\CreateContentablesTable;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    protected function getPackageProviders($app): array
    {
        return [
            ContentServiceProvider::class,
        ];
    }

    /**
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    protected function getEnvironmentSetUp($app)
    {
        (new CreateContentablesTable)->up();
    }
}
