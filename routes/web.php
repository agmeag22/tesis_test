<?php

Route::get('/', function () {
    return view('login');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/only_admin_can_see', 'AdminsOnlyController@only_admin_can_see');
Route::get('/everyone', 'AdminsOnlyController@everyone');
Route::get('/prueba', 'PruebaController@prueba');
Route::get('/publico', 'PublicoController@index');


