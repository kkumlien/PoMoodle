<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;

class StudentDataEntry
{
    /**
     * Saves the activity duration to the database.
     *
     * @param string $userId
     * @param string $cmId
     * @param int $durationInMinutes
     */
    public function saveActivityDuration(string $userId, string $cmId, int $durationInMinutes)
    {
        $this->saveActivityDurationToDatabase($userId, $cmId, $durationInMinutes);

    }

    private function saveActivityDurationToDatabase(string $userId, string $cmId, int $durationInMinutes)
    {
        $results = DB::select('SELECT activity_id FROM pm_activities WHERE user_id = ? AND cm_id = ?', [$userId, $cmId]);

        if (empty($results)) {
            $this->insertActivityDuration($userId, $cmId, $durationInMinutes);
        } else {
            $this->updateActivityDuration($userId, $cmId, $durationInMinutes);
        }
    }


    private function insertActivityDuration(string $userId, string $cmId, int $durationInMinutes)
    {
        DB::insert(
            'INSERT INTO pm_activities (user_id, cm_id, duration_in_minutes) VALUE (?, ?, ?)',
            [$userId, $cmId, $durationInMinutes]
        );
    }


    private function updateActivityDuration(string $userId, string $cmId, int $durationInMinutes)
    {
        DB::update(
            'UPDATE pm_activities SET duration_in_minutes = ? WHERE user_id = ? AND cm_id = ?',
            [$durationInMinutes, $userId, $cmId]
        );
    }


    /**
     * Update the courses model with the duration associated with the cmId.
     *
     * @param array $courses
     * @param string $cmId
     * @param int $durationInMinutes
     */
    public function updateCourseWithNewDuration(array $courses, string $cmId, int $durationInMinutes)
    {
        foreach ($courses as $course) {
            foreach ($course->topics as $topic) {
                foreach ($topic->modules as $module) {
                    if ($module->id == $cmId) {
                        $module->completionStatus->duration_in_minutes = $durationInMinutes;
                        return;
                    }
                }
            }
        }
    }


}