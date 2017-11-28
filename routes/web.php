<?php

Route::get('/', 'HomeController@init');

Route::get('/login', 'LoginController@loginPage');

Route::post('/login', 'LoginController@login')->name('login');

Route::get('/student', 'StudentController@homePage');

Route::get('/trends', 'StudentController@trendsPage');

Route::get('/logout', function () {

    session(['auth' => false]);
    return view('pages.login', ['successMessage' => 'Logged out successfully.']);

});
