<?php

namespace JJSoft\JJSoftApi;

use Dingo\Api\Provider\LaravelServiceProvider;
use League\OAuth2\Server\Exception\OAuthException;
use JJSoft\JJSoftApi\Exceptions\OAuthExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use JJSoft\JJSoftApi\Exceptions\UnauthorizedExceptionHandler;

/**
 * Class DingoApiServiceProvider
 * This is a provider as a temp fix for Dingo API please see https://github.com/dingo/api/pull/776
 * @package JJSoft\JJSoftApi
 */
class DingoApiServiceProvider extends LaravelServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    //    $this->setupConfig();
        parent::register();
    }

    public function boot()
    {
        parent::boot();
        $this->registeroAuthExceptionHandler();
    }

    /**
     * Register the exception handler.
     *
     * @return void
     */
    protected function registeroAuthExceptionHandler()
    {
        $handler = $this->app->make('api.exception');
        $handler->register(function(OAuthException $exception){
            return app(OAuthExceptionHandler::class)->handle($exception);
        });
        $handler->register(function(UnauthorizedHttpException $exception){
            return app(UnauthorizedExceptionHandler::class)->handle($exception);
        });
    }

}