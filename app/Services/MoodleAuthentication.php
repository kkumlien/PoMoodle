<?php

namespace App\Services;


use App\Models\MoodleToken;
use App\Utils\UrlBuilder;

class MoodleAuthentication
{
    /**
     * @var UrlBuilder
     */
    private $urlBuilder;

    /**
     * @var HttpJsonService
     */
    private $httpJsonService;

    /**
     * MoodleAuthentication constructor.
     * @param UrlBuilder $urlBuilder
     * @param HttpJsonService $httpJsonService
     */
    public function __construct(UrlBuilder $urlBuilder, HttpJsonService $httpJsonService)
    {
        $this->urlBuilder = $urlBuilder;
        $this->httpJsonService = $httpJsonService;
    }


    public function authenticateUser(string $moodleUrl, string $username, string $password)
    {
        $url = $this->urlBuilder
            ->newUrl($moodleUrl . '/login/token.php')
            ->withTemp('username', $username)
            ->withTemp('password', $password)
            ->withTemp('service', 'moodle_mobile_app')
            ->build();

        $moodleToken = $this->httpJsonService->getResponseAsObject($url, new MoodleToken());

        if (!empty($moodleToken->token)) {
            return $moodleToken->token;
        }
        return null;
    }

}