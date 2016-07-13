<?php namespace JJSoft\JJSoftApi;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Illuminate\Foundation\AliasLoader;

class JJSoftApiServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    protected $providers = [
        DingoApiServiceProvider::class,
        \Dingo\Api\Provider\LaravelServiceProvider::class,
        \Tymon\JWTAuth\Providers\JWTAuthServiceProvider::class,
        \LucaDegasperi\OAuth2Server\Storage\FluentStorageServiceProvider::class,
        \LucaDegasperi\OAuth2Server\OAuth2ServerServiceProvider::class,
    ];
    protected $aliases   = [
        'JWTAuth' => \Tymon\JWTAuth\Facades\JWTAuth::class,
        'JWTFactory' => \Tymon\JWTAuth\Facades\JWTFactory::class,
        'Authorizer' => \LucaDegasperi\OAuth2Server\Facades\Authorizer::class,
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        $this->handleConfigs();
        $this->handleRoutes();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        $this->registerOtherProviders()
            ->registerAliases();
        \Config::set('jwt.user', \Config::get('auth.model'));

    }

    /**
     * Register other providers
     * @return \JJSoft\JJSoftApi\JJSoftApiServiceProvider
     */
    private function registerOtherProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
        return $this;
    }

    /**
     * Register other aliases
     * @return \JJSoft\JJSoftApi\JJSoftApiServiceProvider
     */
    private function registerAliases()
    {
        foreach ($this->aliases as $alias => $original) {
            AliasLoader::getInstance()->alias($alias, $original);
        }
        return $this;
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {

        return $this->providers;
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/../config/jjsoft-api.php';

        $this->publishes([$configPath => config_path('jjsoft-api.php')]);

        $this->mergeConfigFrom($configPath, 'JSAPIconfig');

        app('Dingo\Api\Auth\Auth')->extend('jwt', function ($app) {
            return new \Dingo\Api\Auth\Provider\JWT($app['Tymon\JWTAuth\JWTAuth']);
        });
    }

    private function handleRoutes() {

        $this->app['router']->middleware('api.cors',
            'JJSoft\JJSoftApi\Http\Middleware\Cors');
        $this->app['router']->middleware('api.csfroff',
            'JJSoft\JJSoftApi\Http\Middleware\CsrfTokenOff');
    }
}
