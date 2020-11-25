<?php

namespace MetroMarkets\FFBundle\Tests;

use MetroMarkets\FFBundle\FeatureFlagService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

class ConfigurationTest extends TestCase
{
    public function testServiceWiring()
    {
        $kernel = new TestingKernel();
        $kernel->boot();

        $container = $kernel->getContainer();

        /** @var FeatureFlagService $service */
        $service = $container->get(FeatureFlagService::class);

        $this->assertInstanceOf(FeatureFlagService::class, $service);
    }

    public function testConfigCatProviderWillFailIfConfigIsNotSet()
    {
        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage('Configcat config must be set when using provider:configcat');

        $kernel = new TestingKernel([
            'provider' => 'configcat',
        ]);

        $kernel->boot();
    }

    public function testConfigCatProviderWillFailIfSdkKeyIsNotSet()
    {
        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage('Configcat sdk_key must be set');

        $kernel = new TestingKernel([
            'provider' => 'configcat',
            'configcat' => [
            ],
        ]);

        $kernel->boot();
    }

    public function testConfigCatProviderWillSuccedWithCorrectConfig()
    {
        $kernel = new TestingKernel([
            'provider' => 'configcat',
            'configcat' => [
                'sdk_key' => 'key'
            ],
        ]);

        $kernel->boot();

        $container = $kernel->getContainer();

        /** @var FeatureFlagService $service */
        $service = $container->get(FeatureFlagService::class);

        $this->assertInstanceOf(FeatureFlagService::class, $service);
    }
}