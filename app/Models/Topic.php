<?php

namespace App\Models;

/**
 * Topic is modeled on Moodle's REST API JSON response to wsfunction core_course_get_contents.
 *
 * Class Topic
 * @package App\Models
 */
class Topic
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

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
    public $summaryformat;

    /**
     * @var int
     */
    public $section;

    /**
     * @var Module[]
     */
    public $modules;


}