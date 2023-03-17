<?php

namespace KUHdo\Content\Tests;

use KUHdo\Content\ContentServiceProvider;
use KUHdo\Content\Tests\Fixtures\CreateContentablesTable;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get the providers for the package test case.
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
     * Get the environment to set up test case.
     *
     * phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    protected function getEnvironmentSetUp($app)
    {
        (new CreateContentablesTable)->up();
    }
}
