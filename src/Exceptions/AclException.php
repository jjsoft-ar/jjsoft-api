<?php

namespace JJSoft\JJSoftApi\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AclException extends UnauthorizedHttpException
{
    public function __construct($challenge = "Acl", $message = "Not enough permissions for the resource", \Exception $previous = null, $code = 0)
    {
        parent::__construct($challenge, $message, $previous, $code);
    }
}