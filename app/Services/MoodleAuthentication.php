<?php

namespace App\Services;


use App\Exceptions\MoodleSiteException;
use App\Models\MoodleToken;
use App\Utils\UrlBuilder;
use Exception;

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


    /**
     * Authenticates user against Moodle and return a MoodleToken if the user credentials are valid.
     *
     * @param string $moodleUrl
     * @param string $username
     * @param string $password
     * @return MoodleToken|null
     */
    public function authenticateUser(string $moodleUrl, string $username, string $password)
    {
        $url = $this->moodleUrlBuilder
            ->newUrl($moodleUrl . '/login/token.php')
            ->with('username', $username)
            ->with('password', $password)
            ->with('service', 'moodle_mobile_app')
            ->build();

        try {
            $moodleToken = $this->httpJsonResponseService->getResponseAsObject($url, new MoodleToken());
        } catch (Exception $exception) {
            throw new MoodleSiteException();
        }

        if (!empty($moodleToken->token)) {
            return $moodleToken->token;
        }
        return null;
    }

}