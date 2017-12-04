<?php

namespace App\Services;


use App\Exceptions\MoodleSiteException;
use App\Models\ActivitiesCompletionStatus;
use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use App\Utils\UrlBuilder;
use GuzzleHttp\Exception\ServerException;

/**
 * Retrieves data from Moodle using its REST API
 *
 * Class MoodleDataRetrieval
 * @package App\Services
 */
class MoodleDataRetrieval
{

    /**
     * @var UrlBuilder
     */
    private $moodleUrlBuilder;

    /**
     * @var HttpJsonResponseService
     */
    private $httpJsonResponseService;

    private const MOODLE_REST_SERVICE =  '/webservice/rest/server.php';

    /**
     * MoodleDataRetrieval constructor
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
     * Retrieves user data from Moodle containing user and course information
     *
     * @param string $moodleUrl
     * @param string $wsToken
     * @return User|object
     */
    public function getUserData(string $moodleUrl, string $wsToken)
    {
        $this->moodleUrlBuilder
            ->newUrl($moodleUrl . self::MOODLE_REST_SERVICE)
            ->withAlways('wstoken', $wsToken)
            ->withAlways('moodlewsrestformat', 'json');

        try {
            $user = $this->getUserInfo();
            $user->courses = $this->getUserCourses($user->userid);
            $this->populateUserCourseData($user);
        } catch (ServerException $exception) {
            throw new MoodleSiteException('Moodle site is down');
        }

        return $user;
    }


    private function getUserInfo()
    {
        $url = $this->moodleUrlBuilder
            ->with('wsfunction', 'core_webservice_get_site_info')
            ->build();

        $user = $this->httpJsonResponseService->getResponseAsObject($url, new User());

        return $user;
    }


    /**
     * @param int $userId
     * @return Course[]
     */
    private function getUserCourses(int $userId)
    {
        $url = $this->moodleUrlBuilder
            ->with('wsfunction', 'core_enrol_get_users_courses')
            ->with('userid', $userId)
            ->build();

        $courses = $this->httpJsonResponseService->getResponseAsObjectArray($url, 'App\Models\Course');

        return $courses;
    }


    private function populateUserCourseData($user)
    {
        foreach ($user->courses as $course) {
            $topics = $this->getCourseContent($course->id);

            $activitiesCompletionStatus = $this->getActivitiesCompletionStatus($user->userid, $course->id);

            //TODO - merge $activitiesCompletionStatus with activities time spent from database

            $topics = $this->mergeActivitiesCompletionStatusToTopics($activitiesCompletionStatus, $topics);

            $course->topics = $topics;
        }
    }


    /**
     * @param int $courseId
     * @return Topic[]
     */
    private function getCourseContent(int $courseId)
    {
        $url = $this->moodleUrlBuilder
            ->with('wsfunction', 'core_course_get_contents')
            ->with('courseid', $courseId)
            ->build();

        $topics = $this->httpJsonResponseService->getResponseAsObjectArray($url, 'App\Models\Topic');

        return $topics;
    }


    private function getActivitiesCompletionStatus(int $userId, int $courseId)
    {
        $url = $this->moodleUrlBuilder
            ->with('wsfunction', 'core_completion_get_activities_completion_status')
            ->with('userid', $userId)
            ->with('courseid', $courseId)
            ->build();

        $activitiesCompletionStatus = $this->httpJsonResponseService->getResponseAsObject($url, new ActivitiesCompletionStatus());

        return $activitiesCompletionStatus;
    }


    private function mergeActivitiesCompletionStatusToTopics($activitiesCompletionStatus, array $topics)
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