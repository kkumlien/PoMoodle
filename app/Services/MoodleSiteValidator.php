<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;
use stdClass;

class MoodleSiteValidator
{
    /**
     * Checks if the moodleSite registered in the database
     *
     * @param string $moodleSite - the Moodle site url or alias
     * @return string moodleUrl if moodle site is registered or null if it's not registered
     */
    public function validateMoodleSite(string $moodleSite)
    {
        $results = DB::select("select * from pm_sites where site_url = '$moodleSite' or site_alias = '$moodleSite'");

        if (!empty($results)) {
            $moodleUrl = $this->getPropertyFromStdClass('site_url', $results[0]);
            return $moodleUrl;
        }

        return null;
    }


    private function getPropertyFromStdClass(string $property, stdClass $stdClass)
    {
        return get_object_vars($stdClass)[$property];
    }

}