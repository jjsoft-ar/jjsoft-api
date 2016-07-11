<?php

namespace JJSoft\JJSoftApi\Tests;

use \Mockery as m;

class TestExceptions extends Boot{

    /**
     * @expectedException     JJSoft\JJSoftApi\Exceptions\AclException
     */
    public function testAclException()
    {
        throw new \JJSoft\JJSoftApi\Exceptions\AclException();
    }

    /**
     * @expectedException     JJSoft\JJSoftApi\Exceptions\ApiModelNotFoundException
     */
    public function testApiModelNotFoundException()
    {
        throw new \JJSoft\JJSoftApi\Exceptions\ApiModelNotFoundException();
    }

    /**
     * @expectedException     JJSoft\JJSoftApi\Exceptions\AuthorizationException
     */
    public function testAuthorizationException()
    {
        throw new \JJSoft\JJSoftApi\Exceptions\AuthorizationException();
    }

    /**
     * @expectedException     JJSoft\JJSoftApi\Exceptions\InvalidArgumentException
     */
    public function testInvalidArgumentException()
    {
        throw new \JJSoft\JJSoftApi\Exceptions\InvalidArgumentException();
    }

    /**
     * @expectedException     JJSoft\JJSoftApi\Exceptions\ValidationException
     */
    public function testValidationException()
    {
        $validator = m::mock('validator')->shouldReceive('errors')->andReturn([])->mock();
        throw new \JJSoft\JJSoftApi\Exceptions\ValidationException($validator);
    }

    /**
     * Mockery
     */
    public function tearDown()
    {
        m::close();
    }

}