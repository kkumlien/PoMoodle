<?php

namespace App\Http\Controllers;


use App\Constants\SessionConstant;
use App\Services\StudentDataEntry;
use App\Utils\CourseUtils;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @var StudentDataEntry
     */
    private $studentDataEntry;


    /**
     * @var CourseUtils
     */
    private $courseUtils;

    /**
     * StudentController constructor.
     * @param StudentDataEntry $studentDataEntry
     * @param CourseUtils $courseUtils
     */
    public function __construct(StudentDataEntry $studentDataEntry, CourseUtils $courseUtils)
    {
        $this->studentDataEntry = new StudentDataEntry();
        $this->courseUtils = new CourseUtils();
    }


    /**
     * Handles requests for the student home page.
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homePage()
    {
        if (!session(SessionConstant::AUTH)) {
            return redirect('login');
        }

        $user = session(SessionConstant::USER);

        return view('pages.student-home')->with('user', $user);
    }


    /**
     * Receives requests for the course page and returns the view with the selected course.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function coursePage(Request $request)
    {
        if (!session(SessionConstant::AUTH)) {
            return redirect('login');
        }

        $courseId = $request->input('courseId');

        $user = session(SessionConstant::USER);

        $course = $this->courseUtils->findCourseFromCourseId($user->courses, $courseId);

        return view('pages.student-courses')->with('course', $course);
    }


    /**
     * Receives requests for updating the activity duration.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function dataEntry(Request $request)
    {
        if (!session(SessionConstant::AUTH)) {
            return redirect('login');
        }

        $cmId = $request->input('cmId');
        $durationInMinutes = $request->input('duration');

        $userId = session(SessionConstant::USER_ID);
        $user = session(SessionConstant::USER);

        $this->studentDataEntry->saveActivityDuration($userId, $cmId, $durationInMinutes);
        $this->studentDataEntry->updateCourseWithNewDuration($user->courses, $cmId, $durationInMinutes);

        return "true";
    }


    /**
     * Handles requests for the student trends page.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trendsPage(Request $request)
    {
        if (!session(SessionConstant::AUTH)) {
            return redirect('login');
        }

        $courseId = $request->input('id');

        $user = session(SessionConstant::USER);

        if ($courseId != null) {
            $course = $this->courseUtils->findCourseFromCourseId($user->courses, $courseId);
        } else {
            $course = $user->courses[0];
        }

        return view('pages.student-trends')->with('course', json_encode($course));
    }

}