<?php

namespace Nyxis\GoogleMapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('nyxis_google_map');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('default')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('locale')->end()
                        ->scalarNode('zoom')
                            ->cannotBeEmpty()
                            ->defaultValue('8')
                        ->end()
                        ->scalarNode('charset')
                            ->cannotBeEmpty()
                            ->defaultValue('UTF8')
                        ->end()
                        ->scalarNode('width')
                            ->cannotBeEmpty()
                            ->defaultValue('425')
                        ->end()
                        ->scalarNode('height')
                            ->cannotBeEmpty()
                            ->defaultValue('350')
                        ->end()
                        ->scalarNode('template')
                            ->cannotBeEmpty()
                            ->defaultValue('NyxisGoogleMapBundle:Map:default.html.twig')
                        ->end()
                        ->scalarNode('type')
                            ->cannotBeEmpty()
                            ->defaultValue('plan')
                            ->validate()
                            ->ifNotInArray(array('plan', 'satelite', 'terrain', 'earth'))
                                ->thenInvalid('Invalid map type "%s"')
                            ->end()
                        ->end()
                        ->scalarNode('container_id')
                            ->cannotBeEmpty()
                            ->defaultValue('nyxis-map-canvas')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('maps')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('place')->end()
                        ->scalarNode('locale')->end()
                        ->scalarNode('zoom')->end()
                        ->scalarNode('charset')->end()
                        ->scalarNode('width')->end()
                        ->scalarNode('height')->end()
                        ->scalarNode('template')->end()
                        ->scalarNode('container_id')->end()
                        ->scalarNode('type')
                            ->validate()
                            ->ifNotInArray(array('plan', 'satelite', 'terrain', 'earth'))
                                ->thenInvalid('Invalid map type "%s"')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
