<?php

Auth::routes();

Route::get('/login', 'PublicHomeController@index');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/only_admin_can_see', 'AdminsOnlyController@only_admin_can_see');
Route::get('/everyone', 'AdminsOnlyController@everyone');
Route::get('/prueba', 'PruebaController@prueba');
Route::get('/', 'PublicHomeController@index');

Route::get('/get_usuarios', 'PublicHomeController@getUsers');
Route::match(['get', 'post'], 'login', function(){
    return redirect('/');
});
