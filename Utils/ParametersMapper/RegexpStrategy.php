<?php

namespace Requestum\RouterDecorationBundle\Utils\ParametersMapper;


class RegexpStrategy implements PatternStrategy
{

    public function createRegexp($data)
    {
        return $data;
    }
}