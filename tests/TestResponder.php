<?php

namespace JJSoft\JJSoftApi\Tests;


use JJSoft\JJSoftApi\Tests\Stubs\ControllerForResponderTrait;

class TestResponder extends Boot{

    /**
     * @var object
     */
    private $traitObject;
    /**
     * Sets up the fixture.
     *
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->traitObject = new ControllerForResponderTrait();
    }

    /**
     * Is it a dingo Response?
     */
    public function testItReturnsDingoResponse()
    {
        $data = [
            'foo' => 'bar'
        ];
        $this->assertInstanceOf('Dingo\Api\Http\Response', $this->traitObject->simpleArray($data));
    }

    /**
     * It the response what it should be?
     */
    public function testItReturnsSimpleArray()
    {
        $data = [
            'foo' => 'bar'
        ];
        $this->assertEquals('{"foo":"bar"}', $this->traitObject->simpleArray($data)->getContent());
    }

    /**
     * It responds created with a 201
     */
    public function testItRespondsCreated()
    {
        $this->assertEquals(201, $this->traitObject->respondCreated()->getStatusCode());
    }

    /**
     * it responds no content with a 204
     */
    public function testRespondsNoContent()
    {
        $this->assertEquals(204, $this->traitObject->responseNoContent()->getStatusCode());
    }

    /**
     * It throws an exception for the dingo responder
     * @expectedException     Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testWithError()
    {
        $this->traitObject->errorInternal();
    }

    /**
     * It throws an exception for the dingo responder
     * @expectedException     Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testErrorUnauthorized()
    {
        $this->traitObject->errorUnauthorized();
    }

}