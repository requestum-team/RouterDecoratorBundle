<?php

namespace Requestum\RouterDecorationBundle\Utils\ParametersMapper;


interface PatternStrategy
{
    public function createRegexp($data);
}