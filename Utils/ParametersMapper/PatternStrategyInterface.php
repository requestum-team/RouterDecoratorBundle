<?php

namespace Requestum\RouterDecorationBundle\Utils\ParametersMapper;


interface PatternStrategyInterface
{
    public function createRegexp($data);
}