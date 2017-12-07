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
}