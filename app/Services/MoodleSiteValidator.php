<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MoodleSiteValidator
{
    /**
     * Checks if the moodleSite registered in the database.
     *
     * @param string $moodleSite - the Moodle site url or alias
     * @return array with siteID and moodleUrl if moodle site is registered or null if it's not registered
     */
    public function validateMoodleSite(string $moodleSite)
    {

        //TODO - create MoodleSite model and return that instead of array

        $results = DB::select('SELECT site_id, site_url FROM pm_sites WHERE site_url = ?'
            . ' OR site_alias = ?', [$moodleSite, $moodleSite]);

        Log::debug(print_r($results, true));

        if (!empty($results)) {
            return $results[0];
        }

        return null;

    }

}