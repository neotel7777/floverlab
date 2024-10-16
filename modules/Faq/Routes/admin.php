<?php

use Illuminate\Support\Facades\Route;

Route::get('faq/items', [
    'as' => 'admin.faq.index',
    'uses' => 'FaqController@index',
    'middleware' => 'can:admin.faq.index',
]);

Route::get('faq/items/create', [
    'as' => 'admin.faq.create',
    'uses' => 'FaqController@create',
    'middleware' => 'can:admin.faq.create',
]);

Route::post('faq/items', [
    'as' => 'admin.faq.store',
    'uses' => 'FaqController@store',
    'middleware' => 'can:admin.faq.create',
]);

Route::get('faq/items/{id}/edit', [
    'as' => 'admin.faq.edit',
    'uses' => 'FaqController@edit',
    'middleware' => 'can:admin.faq.edit',
]);

Route::put('faq/items/{id}', [
    'as' => 'admin.faq.update',
    'uses' => 'FaqController@update',
    'middleware' => 'can:admin.faq.edit',
]);

Route::delete('faq/items/{ids}', [
    'as' => 'admin.faq.destroy',
    'uses' => 'FaqController@destroy',
    'middleware' => 'can:admin.faq.destroy',
]);

Route::get('faq/items/index/table', [
    'as' => 'admin.faq.table',
    'uses' => 'FaqController@table',
    'middleware' => 'can:admin.faq.index',
]);

