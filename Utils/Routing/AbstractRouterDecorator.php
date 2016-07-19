<?php

namespace Requestum\RouterDecorationBundle\Utils\Routing;

use Symfony\Bundle\FrameworkBundle\Routing\Router as BaseRouter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface;
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouterInterface;

abstract class AbstractRouterDecorator implements RouterDecoratorInterface
{
    /** @var  RouterInterface|RequestMatcherInterface|WarmableInterface $decorated */
    protected $decorated;

    /**
     * @param mixed $decorated
     * @throws \InvalidArgumentException
     */
    public function setDecorated($decorated)
    {
        //
        if (!($decorated instanceof RouterInterface) || !($decorated instanceof RequestMatcherInterface) || !($decorated instanceof WarmableInterface)) {
            throw new \InvalidArgumentException('Decorated router must implements every of next interfaces Symfony\Component\Routing\RouterInterface, Symfony\Component\Routing\Matcher\RequestMatcherInterface, Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface');
        }
        
        $this->decorated = $decorated;
    }

    public function generate($name, $parameters = array(), $referenceType = BaseRouter::ABSOLUTE_PATH)
    {
        return $this->getDecorated()->generate($name, $parameters, $referenceType);
    }

    public function matchRequest(Request $request)
    {
        return $this->getDecorated()->matchRequest($request);
    }

    public function match($pathinfo)
    {
        return $this->getDecorated()->match($pathinfo);
    }

    public function setContext(RequestContext $context)
    {
        $this->getDecorated()->setContext($context);
    }

    public function getContext()
    {
        return $this->getDecorated()->getContext();
    }

    public function getRouteCollection()
    {
        return $this->getDecorated()->getRouteCollection();
    }

    public function warmUp($cacheDir)
    {
        return $this->getDecorated()->warmUp($cacheDir);
    }

    protected function getDecorated()
    {
        if (!$this->decorated) {
            throw new \LogicException('You should set decorated router first');
        }
        
        return $this->decorated;
    }
}