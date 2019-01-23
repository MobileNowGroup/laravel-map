<?php

namespace MobileNowGroup\LaravelMap;

use Illuminate\Support\Str;
use MobileNowGroup\LaravelMap\Contracts\MapProvider;

class Map
{
    /** @var MapProvider  */
    protected $provider;

    /** @var Map|null */
    static protected $instance = null;

    /**
     * Map constructor.
     * @param string $providerName
     * @param string $key
     * @param array $arguments
     * @throws MapProviderException
     */
    public function __construct($providerName, $key, ...$arguments)
    {
        $providerClass = sprintf('%s\\Providers\\%s', __NAMESPACE__, Str::studly($providerName));

        if (!class_exists($providerClass)) {
            throw new MapProviderException();
        }

        $this->provider = new $providerClass($key, $arguments);
    }

    /**
     * @param $address
     * @param string|null $city
     * @return mixed
     */
    public static function getCoordinates($address, $city = null)
    {
        return static::$instance->provider->getCoordinates($address, $city);
    }

    /**
     * @param string $providerName
     * @param string $key
     * @param mixed ...$arguments
     * @return Map|null
     * @throws MapProviderException
     */
    public static function make($providerName, $key, ...$arguments): Map
    {
        if (static::$instance) {
            return static::$instance;
        }

        return static::$instance = new static($providerName, $key, ...$arguments);
    }

    /**
     * @param string $providerName
     * @param string $key
     * @return Map
     * @throws MapProviderException
     */
    public static function __callStatic($providerName, $key, ...$arguments): Map
    {
        return static::make($providerName, $key, ...$arguments);
    }
}