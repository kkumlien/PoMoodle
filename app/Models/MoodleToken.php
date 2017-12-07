<?php

namespace App\Models;

/**
 * MoodleToken is modeled on the wstoken received from Moodle's authentication response from a successful request to
 * authenticate a user.
 *
 * Class MoodleToken
 * @package App\Models
 */
class MoodleToken
{
    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $privatetoken;

}