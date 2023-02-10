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
     * @param Application $app
     * @return string[]
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
     * @param Application $app
     * @return void
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    protected function getEnvironmentSetUp($app)
    {
        (new CreateContentablesTable)->up();
    }
}
