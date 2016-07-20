<?php

namespace Requestum\RouterDecorationBundle\Exceptions;

use Exception;

class NotAllowedDecoratorException extends Exception implements NotAllowedDecoratorExceptionInterface
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}