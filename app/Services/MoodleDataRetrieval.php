<?php

namespace App\Services;


use App\Exceptions\MoodleSiteException;
use App\Models\ActivitiesCompletionStatus;
use App\Models\User;
use App\Utils\UrlBuilder;
use GuzzleHttp\Exception\ServerException;

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
     * @var HttpJsonService
     */
    private $httpJsonService;

    /**
     * MoodleDataRetrieval constructor.
     * @param UrlBuilder $urlBuilder
     * @param HttpJsonService $httpJsonService
     */
    public function __construct(UrlBuilder $urlBuilder, HttpJsonService $httpJsonService)
    {
        $this->urlBuilder = $urlBuilder;
        $this->httpJsonService = $httpJsonService;
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


    private function getUserInfo()
    {
        $url = $this->urlBuilder
            ->withTemp('wsfunction', 'core_webservice_get_site_info')
            ->build();

        $user = $this->httpJsonService->getResponseAsObject($url, new User());

        return $user;
    }


    private function getUserCourses(int $userId)
    {
        $url = $this->urlBuilder
            ->withTemp('wsfunction', 'core_enrol_get_users_courses')
            ->withTemp('userid', $userId)
            ->build();

        $courses = $this->httpJsonService->getResponseAsObjectArray($url, 'App\Models\Course');

        return $courses;
    }


    private function getCourseData($user)
    {
        foreach ($user->courses as $course) {
            $topics = $this->getCourseContent($course->id);

            $activitiesCompletionStatus = $this->getActivitiesCompletionStatus($user->userid, $course->id);

            //TODO - merge $activitiesCompletionStatus with activities time spent from database

            $topics = $this->mergeActivitiesCompletionStatusToTopics($activitiesCompletionStatus, $topics);

            $course->topics = $topics;
        }

        return $user;
    }


    private function getCourseContent(int $courseId)
    {
        $url = $this->urlBuilder
            ->withTemp('wsfunction', 'core_course_get_contents')
            ->withTemp('courseid', $courseId)
            ->build();

        $topics = $this->httpJsonService->getResponseAsObjectArray($url, 'App\Models\Topic');

        return $topics;
    }


    private function getActivitiesCompletionStatus(int $userId, int $courseId)
    {
        $url = $this->urlBuilder
            ->withTemp('wsfunction', 'core_completion_get_activities_completion_status')
            ->withTemp('userid', $userId)
            ->withTemp('courseid', $courseId)
            ->build();

        $activitiesCompletionStatus = $this->httpJsonService->getResponseAsObject($url, new ActivitiesCompletionStatus());

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

}