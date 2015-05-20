<?php

namespace Fakerino\Bundle\FakerinoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fakerino');

        $rootNode
            ->children()
                ->arrayNode('config')
                    ->children()
                        ->scalarNode('fakerinoTag')->defaultValue('fake')->end()
                        ->scalarNode('locale')->defaultValue('en-GB')->end()
                        ->scalarNode('fakeFilePath')->defaultValue('/data')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}