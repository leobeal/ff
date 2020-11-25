<?php

namespace MetroMarkets\FFBundle\DependencyInjection;


use MetroMarkets\FFBundle\FeatureFlagService;
use MetroMarkets\FFBundle\Providers\ConfigCatProvider;
use MetroMarkets\FFBundle\Providers\FalseProvider;
use MetroMarkets\FFBundle\Providers\RandomProvider;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;


class MetroMarketsFFExtension extends Extension
{
    public function getAlias()
    {
        return 'metro_markets_ff';
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $adapter = $config['provider'];

        switch ($adapter) {
            case 'configcat':
                $this->configureConfigCat($container, $config);
                break;
            case 'random':
                $this->configureRandom($container);
                break;
            //logger is the default
            default:
                $serviceDefinition = $container->getDefinition(FeatureFlagService::class);
                $serviceDefinition->setArgument(0, new Reference(FalseProvider::class));

                break;
        }
    }

    private function configureConfigCat(ContainerBuilder $container, array $config)
    {
        $adapterDefinition = $container->getDefinition(ConfigCatProvider::class);

        if (!isset($config['configcat'])) {
            throw new InvalidConfigurationException('Configcat config must be set when using provider:configcat');
        }

        if (!isset($config['configcat']['sdk_key'])) {
            throw new InvalidConfigurationException('Configcat sdk_key must be set');
        }

        $adapterDefinition->setArgument(0, $config['configcat']['sdk_key']);

        $serviceDefinition = $container->getDefinition(FeatureFlagService::class);
        $serviceDefinition->setArgument(0, new Reference(ConfigCatProvider::class));
    }

    private function configureRandom(ContainerBuilder $container)
    {
        $serviceDefinition = $container->getDefinition(FeatureFlagService::class);
        $serviceDefinition->setArgument(0, new Reference(RandomProvider::class));
    }
}