<?php

namespace App\Http\Controllers;

use Validator;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen.
    |
    */

    // use AuthenticatesUsers;

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'moodleSite' => [Rule::in(['https://pomodoro-moodle.c9users.io/moodle'])]
        ], [
            'moodleSite.in' => 'Moodle site not registered.'
        ]);

        if ($validator->fails()) {

            return redirect('/')
                ->withErrors($validator)
                ->withInput();

        }

        $validator = Validator::make($request->all(), [
            'username' => [Rule::in(['finn'])]
        ,   'password' => [Rule::in(['finn'])]
        ], [
            'username.in' => 'Invalid user name.'
        ,   'password.in' => 'Invalid password.'
        ]);

        if ($validator->fails()) {

            return redirect('/')
                ->withErrors($validator)
                ->withInput();

        }

        session(['auth' => true]);
        return view('pages.student');

    }
}
