<?php

namespace MobileNowGroup\LaravelMap;

use Illuminate\Support\Str;
use MobileNowGroup\LaravelMap\Contracts\MapProvider;

class Map
{
    /** @var MapProvider */
    protected $provider;

    /** @var Map|null */
    static protected $instance = null;

    /**
     * Map constructor.
     * @param string $providerName
     * @param string $key
     * @throws MapProviderException
     */
    public function __construct($providerName, $key)
    {
        $providerClass = sprintf('%s\\Providers\\%s', __NAMESPACE__, Str::studly($providerName));

        if (!class_exists($providerClass)) {
            throw new MapProviderException();
        }

        $this->provider = new $providerClass($key);
    }

    /**
     * @param array $arguments
     * @return mixed
     */
    public static function getCoordinates(...$arguments)
    {
        return static::$instance->provider->getCoordinates($arguments);
    }

    /**
     * @param string $providerName
     * @param string $key
     * @return Map|null
     * @throws MapProviderException
     */
    public static function make($providerName, $key): Map
    {
        if (static::$instance) {
            return static::$instance;
        }

        return static::$instance = new static($providerName, $key);
    }

    /**
     * @param string $providerName
     * @param array $arguments
     * @return Map
     * @throws MapProviderException
     */
    public static function __callStatic($providerName, array $arguments): Map
    {
        return static::make($providerName, $arguments[0]);
    }
}