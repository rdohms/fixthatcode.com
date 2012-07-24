<?php

namespace DMS\Bundle\LauncherBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('dms_launcher');

        $rootNode->children()->scalarNode('enable')->defaultTrue()->end();

        $rootNode->children()->arrayNode('view')->addDefaultsIfNotSet()->children()
            ->scalarNode('stylesheet')->defaultValue('/bundles/dmslauncher/css/launcher.css')->end()
        ->end();

        $rootNode->children()->arrayNode('application')->children()
            ->scalarNode('site_url')->cannotBeEmpty()->isRequired()->end()
            ->scalarNode('twitter_account')->defaultNull()->end()
        ->end();

        $rootNode->children()->arrayNode('whitelist')->addDefaultsIfNotSet()->end();


        return $treeBuilder;
    }
}
