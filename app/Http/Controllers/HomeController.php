<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function init() {

        if (session('auth')) {

            return view('pages.student');

        } else {

            return view('pages.login');
        }
    }
}
