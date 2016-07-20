<?php

namespace Requestum\RouterDecorationBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RouterDecorationPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds('requestum.router_decorator');

        foreach ($taggedServices as $id => $tags) {
            $baseRouterDefinition = $container->findDefinition('router');
            $container->removeDefinition('router');
            $decoratorDefinition = $container->findDefinition($id);
            $container->setDefinition('router', $decoratorDefinition);
            $decoratorDefinition->addMethodCall(
                'setDecorated',
                [$baseRouterDefinition]
            );
        }
    }
}