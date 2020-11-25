<?php

namespace MetroMarkets\FFBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('metro_markets_ff_bundle');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('provider')->defaultValue('null')->end()
                ->scalarNode('cache_driver')->end()
                ->arrayNode('configcat')
                    ->children()
                        ->scalarNode('sdk_key')->end()
                    ->end()
                ->end()
                ->arrayNode('rest')
                    ->children()
                        ->scalarNode('endpoint')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}