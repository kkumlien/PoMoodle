<?php

namespace App\Services;


class MoodleSiteValidator
{
    public function validateMoodleSite(string $moodleSite)
    {
        if ($moodleSite == 'https://pomodoro-moodle.c9users.io/moodle' ||
            $moodleSite == 'ncirl') {
            return 'https://pomodoro-moodle.c9users.io/moodle';
        }
        return null;
    }

}