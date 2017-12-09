<?php

namespace App\Http\Controllers;


use App\Constants\SessionConstant;
use App\Services\StudentDataEntry;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    /**
     * @var StudentDataEntry
     */
    private $studentDataEntry;


    /**
     * StudentController constructor.
     */
    public function __construct()
    {
        $this->studentDataEntry = new StudentDataEntry();
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


    public function coursePage(Request $request)
    {
        if (!session(SessionConstant::AUTH)) {
            return redirect('login');
        }

        $courseId = $request->input('id');

        $user = session(SessionConstant::USER);

        $selectedCourse = null;

        foreach ($user->courses as $course) {
            if ($course->id == $courseId) {
                $selectedCourse = $course;
            }
        }

        return view('pages.student-courses')->with('course', $selectedCourse);
    }


    public function dataEntry(Request $request)
    {
        if (!session(SessionConstant::AUTH)) {
            return redirect('login');
        }

        $cmId = $request->input('cmId');
        $durationInMinutes = $request->input('duration');
        $userId = 1; //TODO - get user id from the session

        $this->studentDataEntry->saveActivityDuration($userId, $cmId, $durationInMinutes);

        return true;
    }


    /**
     * Handles requests for the student trends page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trendsPage()
    {
        if (!session(SessionConstant::AUTH)) {
            return redirect('login');
        }

        $user = session(SessionConstant::USER);

        $course = $user->courses[0];

        return view('pages.student-trends')->with('course', json_encode($course));
    }

}