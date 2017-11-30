<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class StudentController extends Controller
{

    /**
     * Handles requests for the student home page
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homePage()
    {
        if (!session('auth')) {
            return redirect('login');
        }

        $user = session('user');

        return view('pages.student')->with('user', $user);
    }


    public function coursePage(Request $request)
    {
        if (!session('auth')) {
            return redirect('login');
        }

        $courseId = $request->input('id');

        $user = session('user');

        $selectedCourse = null;

        foreach ($user->courses as $course) {
            if ($course->id == $courseId) {
                $selectedCourse = $course;
            }
        }

        return view('pages.student-course')->with('course', $selectedCourse);
    }


    /**
     * Handles requests for the student trends page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trendsPage()
    {
        if (!session('auth')) {
            return redirect('login');
        }

        $user = session('user');

        return view('pages.student-trends')->with('user', json_encode($user));
    }
}