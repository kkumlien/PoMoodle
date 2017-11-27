<?php

namespace App\Models;


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
     * @var array Topic
     */
    public $topics;


}

