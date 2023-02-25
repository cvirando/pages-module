<?php

/**
 * Made by CV. IRANDO
 * https://irando.co.id ©2023
 * info@irando.co.id
 */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('pages')->group(function() {
    Route::get('/', 'PagesController@index')->name('pagesIndex');
    Route::get('/create', 'PagesController@create')->name('pagesCreate');
    Route::post('/store', 'PagesController@store')->name('pagesStore');
    Route::get('/edit/{id}', 'PagesController@edit')->name('pagesEdit');
    Route::put('/update/{id}', 'PagesController@update')->name('pagesUpdate');
    Route::delete('/delete/{id}', 'PagesController@destroy')->name('pagesDelete');
});
