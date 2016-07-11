<?php

namespace JJSoft\JJSoftApi\Tests;

class Boot extends \Orchestra\Testbench\TestCase{

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('jwt.user', 'JJSoft\JJSoftApi\Tests\Stubs\UserModel');
    }

    protected function getPackageProviders($app)
    {
        return ['JJSoft\JJSoftApi\JJSoftApiServiceProvider'];
    }

    /**
     * Testing Laravel application.
     */
    public function testBoot()
    {
        $this->assertArrayHasKey('data', ['data' => 'foo']);
    }

}