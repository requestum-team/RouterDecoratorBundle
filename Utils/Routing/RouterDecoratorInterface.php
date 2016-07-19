<?php

namespace Requestum\RouterDecorationBundle\Utils\Routing;


use Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface;
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
use Symfony\Component\Routing\RouterInterface;

interface RouterDecoratorInterface extends RouterInterface, RequestMatcherInterface, WarmableInterface
{
    public function setDecorated($decorated);
}