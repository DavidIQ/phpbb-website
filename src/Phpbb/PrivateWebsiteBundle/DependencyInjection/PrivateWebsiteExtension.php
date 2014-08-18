<?php
/**
 *
 * @package PrivateWebsiteBundle
 * @copyright (c) 2014 phpBB Group
 * @license Not for re-distribution
 * @author MichaelC
 *
 */

namespace Phpbb\PrivateWebsiteBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class PrivateWebsiteBundleExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
