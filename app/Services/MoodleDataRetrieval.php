<?php

namespace App\Services;


use App\Models\ActivitiesCompletionStatus;
use App\Models\User;
use App\Utils\UrlBuilder;
use GuzzleHttp\Client;
use JsonMapper;

/**
 * Retrieves data from Moodle using it's REST API
 *
 * Class MoodleDataRetrieval
 * @package App\Services
 */
class MoodleDataRetrieval
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
     * MoodleDataRetrieval constructor.
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
            ->withAlways("wstoken", $wsToken)
            ->withAlways("moodlewsrestformat", "json");

        $user = $this->getUserInfo();

        $user->courses = $this->getUserCourses($user->userid);

        $user = $this->getCourseData($user);

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


    private function getCourseData($user)
    {
        foreach ($user->courses as $course) {
            $topics = $this->getCourseContent($course->id);

            $activitiesCompletionStatus = $this->getActivitiesCompletionStatus($user->userid, $course->id);

            $topics = $this->mergeActivitiesCompletionStatusToTopics($activitiesCompletionStatus, $topics);

            $course->topics = $topics;
        }

        return $user;
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


    private function getActivitiesCompletionStatus(int $userId, int $courseId)
    {
        $url = $this->urlBuilder
            ->withTemp("wsfunction", "core_completion_get_activities_completion_status")
            ->withTemp("userid", $userId)
            ->withTemp("courseid", $courseId)
            ->build();

        $activitiesCompletionStatus = $this->getResponseAsObject($url, new ActivitiesCompletionStatus());

        return $activitiesCompletionStatus;
    }


    public function mergeActivitiesCompletionStatusToTopics($activitiesCompletionStatus, array $topics)
    {

        $completionStatuses = $activitiesCompletionStatus->statuses;

        $moduleIndex = 0;

        for ($i = 1; $i < count($topics); $i++) {
            $modules = $topics[$i]->modules;

            foreach ($modules as $module) {
                $module->completionStatus = $completionStatuses[$moduleIndex++];
            }
        }

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