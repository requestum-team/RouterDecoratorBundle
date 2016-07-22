<?php

namespace Requestum\RouterDecorationBundle\Utils\ParametersMapper;


class RegexpStrategy implements PatternStrategyInterface
{

    public function createRegexp($data)
    {
        return $data;
    }
}