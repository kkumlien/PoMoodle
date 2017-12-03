<?php

namespace App\Models;


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