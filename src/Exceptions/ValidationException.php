<?php

namespace JJSoft\JJSoftApi\Exceptions;

use Dingo\Api\Exception\ResourceException;


class ValidationException extends ResourceException{

    public function __construct($validator) {
        parent::__construct('Validation Fail', $validator->errors(), null, [], 0);
    }

}
