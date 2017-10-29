<?php

Route::get('/', 'HomeController@init');

Route::post('/', 'LoginController@login')->name('login');
