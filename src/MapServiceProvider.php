<?php

namespace MobileNowGroup\LaravelMap;

use Illuminate\Support\ServiceProvider;

class PayServiceProvider extends ServiceProvider
{
    /**
     * If is defer.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the service.
     *
     */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/config/map.php' => config_path('map.php'),],
            'laravel-map'
        );

    }

    /**
     * Register the service.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/config/map.php', 'map');

        $this->app->singleton('map.baidu', function () {
            return Map::baidu(config('map.providers.baidu.key'));
        });
        $this->app->singleton('map.tencent', function () {
            return Map::tencent(config('map.providers.tencent.key'));
        });
    }

    /**
     * Get services.
     *
     * @return array
     */
    public function provides()
    {
        return ['map.baidu', 'map.tencent'];
    }
}