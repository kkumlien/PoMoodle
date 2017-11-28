<?php

namespace App\Services;


use App\Models\User;
use App\Utils\UrlBuilder;
use GuzzleHttp\Client;
use JsonMapper;

/**
 * Retrieves data from Moodle using it's REST API
 *
 * Class MoodleRestService
 * @package App\Services
 */
class MoodleRestService
{

    /**
     * @var UrlBuilder
     */
    private $urlBuilder;

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var JsonMapper
     */
    private $jsonMapper;


    /**
     * MoodleRestService constructor.
     *
     * @param UrlBuilder $urlBuilder
     * @param Client $httpClient
     * @param JsonMapper $jsonMapper
     */
    public function __construct(UrlBuilder $urlBuilder, Client $httpClient, JsonMapper $jsonMapper)
    {
        $this->urlBuilder = $urlBuilder;
        $this->httpClient = $httpClient;
        $this->jsonMapper = $jsonMapper;
        $this->jsonMapper->bStrictNullTypes = false;
    }


    /**
     * Retrieves user data from Moodle containing user and course information
     *
     * @param string $moodleUrl
     * @param string $wsToken
     * @return User|object
     */
    public function getUserData(string $moodleUrl, string $wsToken)
    {
        $this->urlBuilder
            ->newUrl($moodleUrl . "/webservice/rest/server.php")
            ->withalways("wstoken", $wsToken)
            ->withAlways("moodlewsrestformat", "json");

        $user = $this->getUserInfo();

        $user->courses = $this->getUserCourses($user->userid);

        foreach ($user->courses as $course) {
            $course->topics = $this->getCourseContent($course->id);
        }

        return $user;
    }


    private function getUserInfo()
    {
        $url = $this->urlBuilder
            ->withTemp("wsfunction", "core_webservice_get_site_info")
            ->build();

        $user = $this->getResponseAsObject($url, new User());

        return $user;
    }


    private function getUserCourses(int $userId)
    {
        $url = $this->urlBuilder
            ->withTemp("wsfunction", "core_enrol_get_users_courses")
            ->withTemp("userid", $userId)
            ->build();

        $courses = $this->getResponseAsObjectArray($url, 'App\Models\Course');

        return $courses;
    }


    private function getCourseContent(int $courseId)
    {
        $url = $this->urlBuilder
            ->withTemp("wsfunction", "core_course_get_contents")
            ->withTemp("courseid", $courseId)
            ->build();

        $topics = $this->getResponseAsObjectArray($url, 'App\Models\Topic');

        return $topics;
    }


    private function getResponseAsObject(string $url, $object)
    {
        $response = $this->httpClient->get($url);
        $json = $response->getBody();
        $object = $this->jsonMapper->map(json_decode($json), $object);

        return $object;
    }


    private function getResponseAsObjectArray(string $url, string $class)
    {
        $response = $this->httpClient->get($url);
        $json = $response->getBody();
        $objectArray = $this->jsonMapper->mapArray(json_decode($json), array(), $class);

        return $objectArray;
    }

}