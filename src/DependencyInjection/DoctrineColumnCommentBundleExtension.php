<?php

declare(strict_types=1);

namespace Dsnetpl\DoctrineColumnCommentBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class DoctrineColumnCommentBundleExtension extends Extension
{
    /**
     * @param string[] $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container,
            new FileLocator(__DIR__.'/../../config'));

        $loader->load('services.yaml');
    }
}
