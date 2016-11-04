<?php

namespace BrianFaust\Tests\Sociable;

use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    protected function getServiceProviderClass($app)
    {
        return \BrianFaust\Sociable\ServiceProvider::class;
    }
}
