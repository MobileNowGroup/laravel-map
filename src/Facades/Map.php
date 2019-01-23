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
        return 'map.provider';
    }
}