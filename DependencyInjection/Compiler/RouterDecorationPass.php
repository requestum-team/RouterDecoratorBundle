<?php

namespace Requestum\RouterDecorationBundle\DependencyInjection\Compiler;


use Requestum\RouterDecorationBundle\Routing\RouterDecoratorInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RouterDecorationPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     * @throws \InvalidArgumentException
     */
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds('requestum.router_decorator');

        foreach ($taggedServices as $id => $tags) {
            $baseRouterDefinition = $container->findDefinition('router');
            $container->removeDefinition('router');
            $decoratorDefinition = $container->findDefinition($id);
            if (!is_a($decoratorDefinition->getClass(), RouterDecoratorInterface::class, true)) {
                throw new \InvalidArgumentException(
                    "Service {$id} is not implementation of " . RouterDecoratorInterface::class
                );
            }
            $container->setDefinition('router', $decoratorDefinition);
            $decoratorDefinition->addMethodCall(
                'setDecorated',
                [$baseRouterDefinition]
            );
        }
    }
}