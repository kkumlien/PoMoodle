<?php

Route::get('/', 'HomeController@init');

Route::get('/login', 'LoginController@loginPage');

Route::post('/login', 'LoginController@login')->name('login');

Route::get('/student', 'StudentController@homePage');

Route::get('/course', 'StudentController@coursePage');

Route::get('/data-entry', 'StudentController@dataEntry');

Route::get('/trends', 'StudentController@trendsPage');

Route::get('/logout', function () {

    session(['auth' => false]);
    return view('pages.login', ['successMessage' => 'Logged out successfully.']);

});
