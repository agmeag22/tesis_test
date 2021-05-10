<?php



Route::prefix('administration/iudop/secret/')->group(function() {
	Auth::routes();
});
Route::get('/administration/iudop/secret/logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

Route::get('/', 'PublicHomeController@index');
Route::get('/home', 'AdminsOnlyController@only_admin_can_see');
Route::get('/only_admin_can_see', 'AdminsOnlyController@only_admin_can_see');
Route::get('/everyone', 'AdminsOnlyController@everyone');
Route::get('/prueba', 'PruebaController@prueba');
Route::get('/get_usuarios', 'PublicHomeController@getUsers');