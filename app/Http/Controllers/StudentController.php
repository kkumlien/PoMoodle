<?php

namespace App\Http\Controllers;


use App\Models\Person;
use App\Services\RestMapperService;

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

        return view('pages.student-trends');
    }
}