<?php



declare(strict_types=1);

namespace BrianFaust\Tests\Sociable;

use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    protected function getServiceProviderClass($app): string
    {
        return \BrianFaust\Sociable\ServiceProvider::class;
    }
}
