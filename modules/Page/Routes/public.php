<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/{slug}', 'PageController@show')->name('pages.show');
