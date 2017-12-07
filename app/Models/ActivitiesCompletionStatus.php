<?php

namespace App\Models;

/**
 * ActivitiesCompletionStatus is modeled on the Moodle REST API response to wsfunction
 * core_completion_get_activities_completion_status.
 *
 * Class ActivitiesCompletionStatus
 * @package App\Models
 */
class ActivitiesCompletionStatus
{
    /**
     * @var CompletionStatus[]
     */
    public $statuses;

}