<?php

namespace App\Services;


use App\Models\MoodleToken;
use App\Utils\UrlBuilder;

class MoodleAuthentication
{
    /**
     * @var UrlBuilder
     */
    private $moodleUrlBuilder;

    /**
     * @var HttpJsonResponseService
     */
    private $httpJsonResponseService;

    /**
     * MoodleAuthentication constructor.
     *
     * @param UrlBuilder $moodleUrlBuilder
     * @param HttpJsonResponseService $httpJsonResponseService
     */
    public function __construct(UrlBuilder $moodleUrlBuilder, HttpJsonResponseService $httpJsonResponseService)
    {
        $this->moodleUrlBuilder = $moodleUrlBuilder;
        $this->httpJsonResponseService = $httpJsonResponseService;
    }


    public function authenticateUser(string $moodleUrl, string $username, string $password)
    {
        $url = $this->moodleUrlBuilder
            ->newUrl($moodleUrl . '/login/token.php')
            ->with('username', $username)
            ->with('password', $password)
            ->with('service', 'moodle_mobile_app')
            ->build();

        $moodleToken = $this->httpJsonResponseService->getResponseAsObject($url, new MoodleToken());

        if (!empty($moodleToken->token)) {
            return $moodleToken->token;
        }
        return null;
    }

}