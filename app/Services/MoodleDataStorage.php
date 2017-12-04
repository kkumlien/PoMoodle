<?php

namespace App\Services;

use App\Exceptions\MoodleSiteException;
use App\Models\User;
use App\Utils\UrlBuilder;
use GuzzleHttp\Exception\ServerException;

/**
 * Stores data from Moodle into our own database
 *
 * Class MoodleDataStorage
 * @package App\Services
 */
class MoodleDataStorage
{

    /**
     * @var UrlBuilder
     */
    private $urlBuilder;

    /**
     * @var HttpJsonResponseService
     */
    private $httpJsonResponse;

    /**
     * MoodleDataRetrieval constructor
     *
     * @param UrlBuilder $urlBuilder
     * @param HttpJsonResponseService $httpJsonResponse
     */
    public function __construct(UrlBuilder $urlBuilder, HttpJsonResponseService $httpJsonResponse)
    {
        $this->urlBuilder = $urlBuilder;
        $this->httpJsonResponse = $httpJsonResponse;
    }


    /**
     * Retrieves user data from Moodle containing user and course information
     *
     * @param User $user
     * @return User|object
     */
    public function storeUserData(User $user)
    {
        $this->urlBuilder
            ->newUrl($moodleUrl . '/webservice/rest/server.php')
            ->withAlways('wstoken', $wsToken)
            ->withAlways('moodlewsrestformat','json');

        try {
            $user = $this->getUserInfo();
            $user->courses = $this->getUserCourses($user->userid);
            $user = $this->getCourseData($user);
        } catch (ServerException $exception) {
            throw new MoodleSiteException('Moodle site is down');
        }

        return $user;
    }

}