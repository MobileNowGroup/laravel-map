<?php

namespace MobileNowGroup\LaravelMap\Contracts;

interface MapProvider
{
    /**
     * @return mixed
     */
    public function getCoordinates();
}