<?php

namespace App\Http\Controllers;

use App\Constants\SessionConstant;

class HomeController extends Controller
{
    public function init() {

        if (session(SessionConstant::AUTH)) {

            return redirect('student');

        } else {

            return redirect('login');
        }
    }
}
