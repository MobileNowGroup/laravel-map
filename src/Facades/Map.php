<?php

namespace MobileNowGroup\LaravelMap\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getCoordinates(string $address, $city = null)
 *
 * @see \MobileNowGroup\LaravelMap\Map
 */
class Map extends Facade
{
    /**
     * Return the facade accessor.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'map';
    }
}