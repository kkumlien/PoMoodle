<?php

Route::get('/', 'HomeController@init');

Route::post('/', 'LoginController@login')->name('login');

Route::get('/trends', 'TrendsController@init');

Route::get('/logout', 'LoginController@login');