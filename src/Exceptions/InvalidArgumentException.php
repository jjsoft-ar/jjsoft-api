<?php

namespace JJSoft\JJSoftApi\Exceptions;

use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class InvalidArgumentException extends ServiceUnavailableHttpException
{

    public function __construct($retryAfter = null, $message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct($retryAfter, $message, $previous, $code);
    }

}
