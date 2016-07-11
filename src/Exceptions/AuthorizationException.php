<?php

namespace JJSoft\JJSoftApi\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthorizationException extends UnauthorizedHttpException
{
    public function __construct($challenge = "Token", $message = "Authorization Failed", \Exception $previous = null, $code = 0)
    {
        parent::__construct($challenge, $message, $previous, $code);
    }
}