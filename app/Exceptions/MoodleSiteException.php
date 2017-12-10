<?php

namespace App\Exceptions;


use RuntimeException;

class MoodleSiteException extends RuntimeException
{
    public function __construct($message = 'Moodle site not responsive', $code = 0, RuntimeException $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}