<?php

namespace App\Models;

/**
 * User is modeled on the Moodle REST API response to wsfunction core_webservice_get_site_info.
 *
 * Class User
 * @package App\Models
 */
class User
{
    /**
     * @var int
     */
    public $userid;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $firstname;

    /**
     * @var string
     */
    public $lastname;

    /**
     * @var string
     */
    public $fullname;

    /**
     * @var string
     */
    public $siteurl;

    /**
     * @var string
     */
    public $sitename;

    /**
     * @var Course[]
     */
    public $courses;


}