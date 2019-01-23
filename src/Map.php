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
     * @param array $arguments
     * @throws MapProviderException
     */
    public function __construct($providerName, ...$arguments)
    {
        $providerClass = sprintf('%s\\Providers\\%s', __NAMESPACE__, Str::studly($providerName));

        if (!class_exists($providerClass)) {
            throw new MapProviderException();
        }

        $this->provider = new $providerClass($arguments);
    }

    /**
     * @param $providerName
     * @param mixed ...$arguments
     * @return Map|null
     * @throws MapProviderException
     */
    public function make($providerName, ...$arguments): Map
    {
        if (static::$instance) {
            return static::$instance;
        }

        return static::$instance = new static($providerName, $arguments);
    }

    /**
     * @param $providerName
     * @param $arguments
     * @return Map
     * @throws MapProviderException
     */
    public function __call($providerName, $arguments): Map
    {
        return $this->make($providerName, $arguments);
    }
}