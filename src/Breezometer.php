<?php namespace Nwidart\Breezometer;

use GuzzleHttp\Client;

class Breezometer
{
    /**
     * @var string
     */
    private $apiKey;

    private $endpoint = 'http://api-beta.breezometer.com';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Get BreezoMeter Air Quality Index (BAQI) by Latitude & Longitude
     * @param string $lat
     * @param string $lon
     * @return array
     */
    public function baqi($lat, $lon)
    {
        $this->guardAgainstEmptyArguement($lat, 'latitude');
        $this->guardAgainstEmptyArguement($lon, 'longitude');

        $baqi = $this->getClient()->get("{$this->endpoint}/baqi/?lat={$lat}&lon={$lon}&key={$this->apiKey}");

        return $baqi->json();
    }

    /**
     * Get BreezoMeter Air Quality Index (BAQI) by Address or Location
     * @param string $location
     * @return array
     */
    public function baqiFromLocation($location)
    {
        $this->guardAgainstEmptyArguement($location, 'location');

        $baqi = $this->getClient()->get("{$this->endpoint}/baqi/?location={$location}&key={$this->apiKey}");

        return $baqi->json();
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        return new Client();
    }

    /**
     * Guard against empty arguments
     * @param string $argument
     * @param string $argumentName
     */
    private function guardAgainstEmptyArguement($argument, $argumentName)
    {
        if (empty($argument)) {
            throw new \InvalidArgumentException("$argumentName is required.");
        }
    }
}
