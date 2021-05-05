<?php
namespace Baptou\TopSolidBundle\DependencyInjection;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('topsolid');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
                ->scalarNode('key')
                ->isRequired()
                ->end()

            ->scalarNode('base_url')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->end();
        return $treeBuilder;

    }
}