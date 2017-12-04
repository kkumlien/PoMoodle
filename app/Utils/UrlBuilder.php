<?php

namespace App\Utils;


use RuntimeException;

/**
 * Builds a parameterized url using the $baseUrl with $permanentParameters that will be used in every url build and
 * $temporaryParameters which will be cleared after each url build. All functions except for build return $this to allow
 * for function chaining.
 *
 * Class UrlBuilder
 * @package App\Utils
 */
class UrlBuilder
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var array - key => value
     */
    private $permanentParameters;

    /**
     * @var array - key => value
     */
    private $temporaryParameters;


    /**
     * Sets the $baseUrl and clears all saved parameters
     *
     * @param string $baseUrl
     * @return $this
     */
    public function newUrl(string $baseUrl) {
        $this->baseUrl = $baseUrl;
        $this->temporaryParameters = [];
        $this->permanentParameters = [];
        return $this;
    }


    /**
     * Adds the a key and value to the parameters array. This parameter will used for every url build unless a new url
     * is created using the newUrl function
     *
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function withAlways(string $key, string $value)
    {
        $this->permanentParameters[$key] = $value;
        return $this;
    }


    /**
     * Adds the a key and value to the parameters array. These parameters are temporary and will be cleared after
     * from the UrlBuilder after the url has been built.
     *
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function with(string $key, string $value)
    {
        $this->temporaryParameters[$key] = $value;;
        return $this;
    }


    /**
     * Added the parameters to the baseUrl and return a parameterized url
     *
     * @return string
     */
    public function build()
    {
        if ($this->baseUrl == null) {
            throw new RuntimeException("base url not set");
        }

        $url = $this->baseUrl . "?";
        $parameters = array_merge($this->permanentParameters, $this->temporaryParameters);

        $index = 0;
        foreach ($parameters as $key => $value) {
            $url .= $key . "=" . $value;
            $index++;
            if ($index < count($parameters)) {
                $url .= "&";
            }
        }

        $this->temporaryParameters = [];

        return $url;
    }

}