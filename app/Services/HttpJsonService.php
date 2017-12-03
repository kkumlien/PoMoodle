<?php

namespace App\Services;


use GuzzleHttp\Client;
use JsonMapper;

class HttpJsonService
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var JsonMapper
     */
    private $jsonMapper;

    /**
     * HttpJsonService constructor.
     * @param Client $httpClient
     * @param JsonMapper $jsonMapper
     */
    public function __construct(Client $httpClient, JsonMapper $jsonMapper)
    {
        $this->httpClient = $httpClient;
        $this->jsonMapper = $jsonMapper;
    }


    public function getResponseAsObject(string $url, $object)
    {
        $response = $this->httpClient->get($url);
        $json = $response->getBody();
        $object = $this->jsonMapper->map(json_decode($json), $object);

        return $object;
    }


    public function getResponseAsObjectArray(string $url, string $class)
    {
        $response = $this->httpClient->get($url);
        $json = $response->getBody();
        $objectArray = $this->jsonMapper->mapArray(json_decode($json), array(), $class);

        return $objectArray;
    }
}