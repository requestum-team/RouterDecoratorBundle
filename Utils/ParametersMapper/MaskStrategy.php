<?php

namespace Requestum\RouterDecorationBundle\Utils\ParametersMapper;


class MaskStrategy implements PatternStrategyInterface
{

    public function createRegexp($data)
    {
        $data = str_replace("%*%", ".*", $data);
        $data = '/' . $data . '/';
        return $data;
    }
}