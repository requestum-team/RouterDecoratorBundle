<?php

namespace Requestum\RouterDecorationBundle\Routing\Decorator;

use Requestum\RouterDecorationBundle\Routing\AbstractRouterDecorator;
use Requestum\RouterDecorationBundle\Utils\ParametersMapper\ParametersMapper;
use Symfony\Bundle\FrameworkBundle\Routing\Router as BaseRouter;
use Symfony\Component\HttpFoundation\Request;

class ParametersMapperDecorator extends AbstractRouterDecorator
{
    /**
     * @var ParametersMapper
     */
    protected $parametersMapper;

    public function __construct(ParametersMapper $parametersMapper)
    {
        $this->parametersMapper = $parametersMapper;

    }

    public function generate($name, $parameters = array(), $referenceType = BaseRouter::ABSOLUTE_PATH)
    {
        $mappedParams = $this->mapParams($name, $parameters, 'getUriValue');
        
        return $this->decorated->generate($name, $mappedParams, $referenceType);
    }

    public function matchRequest(Request $request)
    {
        $parameters = $this->decorated->matchRequest($request);

        return $this->mapParams($parameters['_route'], $parameters, 'getSystemValue');
    }

    public function match($pathinfo)
    {
        $parameters = $this->decorated->match($pathinfo);

        return $this->mapParams($parameters['_route'], $parameters, 'getSystemValue');
    }

    protected function mapParams($route, $parameters, $method)
    {
        $mappedParams = [];

        foreach ($parameters as $name => $value) {
            $mappedParams[$name] = $this->parametersMapper->$method($route, $name, $value);
        }

        return $mappedParams;
    }
} 
