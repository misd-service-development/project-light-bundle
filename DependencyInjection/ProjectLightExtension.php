<?php

namespace Misd\ProjectLightBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface as PrependExtension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Project Light bundle extension.
 */
final class ProjectLightExtension extends Extension implements PrependExtension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['KnpMenuBundle'])) {
            $loader->load('knp_menu.xml');
        }
    }

    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['KnpMenuBundle'])) {
            $container->prependExtensionConfig(
              'knp_menu',
              array('default_renderer' => 'project_light')
            );
        }
    }
}
