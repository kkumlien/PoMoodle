<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;

class DataMerge
{

    /**
     * Merges Moodle data with activity duration from local database.
     *
     * @param $userID
     * @param $user
     */
    public function mergeActivityDuration($userID, $user)
    {
        $activitiesFromDB = DB::select('SELECT * FROM pm_activities'
            . ' WHERE user_id = ?', [$userID]);

        foreach ($user->courses as $course) {

            foreach ($course->topics as $topic) {

                foreach ($topic->modules as $module) {

                    $this->setDuration($activitiesFromDB, $module);

                }
            }
        }

    }

    /**
     *
     *
     * @param $activitiesFromDB
     * @param $module
     */
    public function setDuration($activitiesFromDB, $module)
    {
        foreach ($activitiesFromDB as $activity) {

            if ($module->id == $activity->cm_id) {

                $module
                    ->completionStatus
                    ->duration_in_minutes = $activity->duration_in_minutes;

            }
        }
    }

}