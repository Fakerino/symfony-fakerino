<?php
/**
 * This file is part of the Symfony Fakerino Bundle.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
                        ->scalarNode('fakeFilePath')
                            ->defaultValue('%kernel.root_dir%/../vendor/fakerino/fakerino/data')
                            ->end()
                        ->variableNode('database')->end()
                        ->variableNode('fake')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}