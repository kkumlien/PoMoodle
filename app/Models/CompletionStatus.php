<?php

namespace App\Models;

/**
 * CompletionStatus is modeled on the 'modules' array contained in Moodle REST API response to wsfunction
 * core_completion_get_activities_completion_status.
 *
 * Class CompletionStatus
 * @package App\Models
 */
class CompletionStatus
{
    /**
     * @var int
     */
    public $activity_id;
    /**
     * @var int
     */
    public $cmid;
    /**
     * @var int
     */
    public $state;

    /**
     * @var int
     */
    public $timecompleted;

    /**
     * @var int
     */
    public $duration_in_minutes;

    public static function convertToHoursMins($time) {

        if ($time < 1) {
            return;
        }

        $hours = floor($time / 60);
        $minutes = ($time % 60);

        $format = '';

        $format .= $hours > 0 ? '%dh ' : '';
        $format .= $minutes > 0 ? '%dm' : '';

        return $hours > 0 ? sprintf($format, $hours, $minutes) : sprintf($format, $minutes);
    }
}