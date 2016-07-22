<?php

namespace Requestum\RouterDecorationBundle\Utils\ParametersMapper;

class ParametersMapper
{
    /**
     * @var PatternStrategyInterface
     */
    private $strategy;

    public function __construct(array $config, PatternStrategyInterface $strategy)
    {
        $this->config = $config;
        $this->strategy = $strategy;
    }

    public function hasMapping($route)
    {
        return isset($this->config[$route]);
    }

    public function getSystemValue($route, $param, $value)
    {
        if (!($config = $this->getParameterConfig($route, $param))) {
            return $value;
        }

        foreach ($config as $systemValue => $uriValue) {
            if ($uriValue == $value) {
                return $systemValue;
            }
        }

        return $value;
    }

    public function getUriValue($route, $param, $value)
    {
        if (!($config = $this->getParameterConfig($route, $param))) {
            return $value;
        }

        return isset($config[$value]) ? $config[$value] : $value;
    }

    protected function getParameterConfig($route, $param)
    {
        foreach ($this->config as $routeMask => $params) {

            $routeRegexp = $this->createRegexp($routeMask);

            if (preg_match($routeRegexp, $route) && isset($params[$param])) {
                return $params[$param];
            }

        }

        return null;
    }

    /**
     * just passes through regular expression for now
     * if incoming format replaced with some more friendly mask implement regexp compilation here
     */
    protected function createRegexp($mask)
    {
        return $this->strategy->createRegexp($mask);
    }
} 
