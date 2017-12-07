<?php

namespace App\Models;

/**
 * Course is modeled on Moodle's REST API response to wsfunction core_enrol_get_users_courses. $topics is not contained
 * in the response.
 *
 * Class Course
 * @package App\Models
 */
class Course
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $fullname;

    /**
     * @var string
     */
    public $shortname;

    /**
     * @var int
     */
    public $visible;

    /**
     * @var string
     */
    public $summary;

    /**
     * @var int
     */
    public $category;

    /**
     * @var int
     */
    public $progress;

    /**
     * @var int
     */
    public $startdate;

    /**
     * @var int
     */
    public $enddate;

    /**
     * @var Topic[]
     */
    public $topics;


}

