<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;

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
        $results = DB::select('SELECT site_url FROM pm_sites WHERE site_url = ?'
            . ' OR site_alias = ?', [$moodleSite, $moodleSite]);

        if (!empty($results)) {
            return $results[0]->site_url;
        }

        return null;
    }

}