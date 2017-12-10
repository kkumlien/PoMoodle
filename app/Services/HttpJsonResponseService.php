<?php

namespace App\Services;


use GuzzleHttp\Client;
use JsonMapper;

/**
 * Makes http requests to REST APIs that return JSON. The JSON data is then parsed and returned as an object or object
 * array.
 *
 * Class HttpJsonResponseService
 * @package App\Services
 */
class HttpJsonResponseService
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
     * HttpJsonResponse constructor.
     *
     * @param Client $httpClient
     * @param JsonMapper $jsonMapper
     */
    public function __construct(Client $httpClient, JsonMapper $jsonMapper)
    {
        $this->httpClient = $httpClient;
        $this->jsonMapper = $jsonMapper;
        $this->jsonMapper->bStrictNullTypes = false;
    }


    /**
     * Makes a http request and maps the json response to an object.
     *
     * @param string $url - http request url
     * @param $object - the object to parse the json to e.g. new Object
     * @return object
     */
    public function getResponseAsObject(string $url, $object)
    {
        $json = $this->getResponseBody($url);
        $object = $this->jsonMapper->map(json_decode($json), $object);

        return $object;
    }


    /**
     * Makes a http request and maps the json response to an object array.
     *
     * @param string $url - http request url
     * @param string $class - the full path to the class to convert to e.g. 'App\Models\Object'
     * @return array object
     */
    public function getResponseAsObjectArray(string $url, string $class)
    {
        $json = $this->getResponseBody($url);
        $objectArray = $this->jsonMapper->mapArray(json_decode($json), array(), $class);

        return $objectArray;
    }


    private function getResponseBody(string $url)
    {
        $response = $this->httpClient->get($url);
        return $response->getBody();
    }
}