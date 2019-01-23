<?php

namespace MobileNowGroup\LaravelMap;

class MapProviderException extends \Exception
{
    /**
     * MapProviderException constructor.
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message ?: 'We don\'t support this map provider';
    }
}