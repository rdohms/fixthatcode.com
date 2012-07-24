<?php

namespace DMS\Bundle\LauncherBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class DMSLauncherExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        //Set Config values as Parameters for access in templates
        $container->setParameter('dms_launcher.site_url', $config['application']['site_url']);
        $container->setParameter('dms_launcher.twitter_account', $config['application']['twitter_account']);
        $container->setParameter('dms_launcher.stylesheet', $config['view']['stylesheet']);
        $container->setParameter('dms_launcher.whitelist', $config['whitelist']);
        $container->setParameter('dms_launcher.enable', $config['enable']);

    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'dms_launcher';
    }

}
