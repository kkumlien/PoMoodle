<?php

namespace App\Http\Controllers;

use App\Constants\SessionConstant;

class HomeController extends Controller
{
    /**
     * Accepts requests to the root domain and decides which page to redirect to
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function init() {

        if (session(SessionConstant::AUTH)) {

            return redirect('student');

        } else {

            return redirect('login');
        }
    }
}
