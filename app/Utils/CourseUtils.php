<?php

namespace App\Utils;


class CourseUtils
{
    public function findCourseFromCourseId(array $courses, string $courseId)
    {
        $selectedCourse = null;

        foreach ($courses as $course) {
            if ($course->id == $courseId) {
                $selectedCourse = $course;
            }
        }

        return $selectedCourse;
    }

}