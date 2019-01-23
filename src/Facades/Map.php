<?php

namespace MobileNowGroup\LaravelMap\Facades;

use Illuminate\Support\Facades\Facade;

class Map extends Facade
{
    /**
     * Return the facade accessor.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'map.tencent';
    }

    /**
     * Return the facade accessor.
     *
     * @return string
     */
    public static function tencent()
    {
        return app('map.tencent');
    }

    /**
     * Return the facade accessor.
     *
     * @return string
     */
    public static function baidu()
    {
        return app('map.baidu');
    }
}