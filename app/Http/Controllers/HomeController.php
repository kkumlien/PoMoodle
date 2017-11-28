<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function init() {

        if (session('auth')) {

            return redirect('student');

        } else {

            return redirect('login');
        }
    }
}
