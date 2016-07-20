<?php

namespace Requestum\RouterDecorationBundle;

use Requestum\RouterDecorationBundle\DependencyInjection\Compiler\RouterDecorationPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RequestumRouterDecorationBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new RouterDecorationPass());
    }
}
