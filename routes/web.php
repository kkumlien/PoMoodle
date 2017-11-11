<?php

Route::get('/', 'HomeController@init');

Route::post('/login', 'LoginController@login')->name('login');

Route::get('/trends', function () {

    if (session('auth')) return view('pages.student-trends');
    else return view('pages.login', ['dangerMessage' => 'Not authenticated.']);

});

Route::get('/logout', function () {

    session(['auth' => false]);
    return view('pages.login', ['successMessage' => 'Logged out successfully.']);

});
