<?php

namespace MobileNowGroup\LaravelMap\Contracts;

interface MapProvider
{
    /**
     * @param array $arguments
     * @return mixed
     */
    public function getCoordinates(array $arguments);
}