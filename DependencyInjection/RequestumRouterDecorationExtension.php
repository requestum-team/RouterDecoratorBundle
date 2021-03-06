<?php

namespace Requestum\RouterDecorationBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class RequestumRouterDecorationExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $mapperDefinition = $container->findDefinition('parameters_mapper');
        $mapperDefinition->addArgument($config['parameters_mapper']['map']);

        switch ($pattern = $config['parameters_mapper']['pattern']) {
            case 'mask':
                $pattern = sprintf('parameters_mapper.strategy.%s', $pattern);
                break;
            case 'regexp':
                $pattern = sprintf('parameters_mapper.strategy.%s', $pattern);
                break;
        }

        $mapperDefinition->addArgument(new Reference($pattern));
    }
}
