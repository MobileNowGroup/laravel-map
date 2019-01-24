<?php

namespace MobileNowGroup\LaravelMap\Providers;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use MobileNowGroup\LaravelMap\Contracts\MapProvider;

class Baidu implements MapProvider
{
    /** constants */
    const URL = 'https://api.map.baidu.com';
    const COORDINATES_PATH = '/geocoder/v2/';

    /** @var string */
    private $key;
    /** @var string|null */
    private $city;

    /**
     * Baidu constructor.
     * @param $key
     * @param array $arguments
     */
    public function __construct($key, ...$arguments)
    {
        $this->key = $key;
        $this->city = $arguments[0] ?? config('map.city');
    }

    /**
     * @param array $arguments
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCoordinates(array $arguments)
    {
        $client = new Client(['base_uri' => static::URL]);

        try {
            $response = $client->request('GET', static::COORDINATES_PATH, [
                'query' => [
                    'ak' => $this->key,
                    'output' => 'json',
                    'address' => $arguments[0],
                    'city' => $arguments[1] ?? $this->city,
                ],
            ]);

            return $this->parseGeoCoderResult($response);
        } catch (\Exception $e) {
            logger()->error(sprintf("We caught one system error. Message: %s \n Code: %s.", $e->getMessage(),
                $e->getCode()));
            return null;
        }
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws \Exception
     */
    public function parseGeoCoderResult(ResponseInterface $response)
    {
        $body = json_decode($response->getBody());

        if ($body->status != 0) {
            throw new \Exception($body->message);
        }

        $result = $body->result->location;

        return [
            'latitude' => $result->lat,
            'longitude' => $result->lng,
        ];
    }
}