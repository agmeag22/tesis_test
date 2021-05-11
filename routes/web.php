<?php



Route::prefix('/administration/iudop/secret/')->group(function() {
	Auth::routes();

	Route::prefix('/informe/')->group(function() {
		Route::get('informe', 'InformeController@index');
		Route::get('get_informe', 'InformeController@getInforme');
		Route::post('save_informe', 'InformeController@saveInforme');
		Route::post('delete_Informe', 'InformeController@deleteInforme');
	});

	Route::prefix('/categoria/')->group(function() {
		Route::get('categoria', 'CategoriaController@index');
		Route::get('get_categoria', 'CategoriaController@getCategoria');
		Route::post('save_categoria', 'CategoriaController@saveCategoria');
		Route::post('delete_categoria', 'CategoriaController@deleteCategoria');
	});

	Route::prefix('/subcategoria/')->group(function() {
		Route::get('subcategoria', 'SubcategoriaController@index');
		Route::get('get_subcategoria', 'SubcategoriaController@getSubcategoria');
		Route::post('save_subcategoria', 'SubcategoriaController@saveSubcategoria');
		Route::post('delete_subcategoria', 'SubcategoriaController@deleteSubcategoria');
	});

});
Route::get('home', 'AdminsOnlyController@only_admin_can_see');
Route::get('/administration/iudop/secret/logout', 'Auth\LoginController@logout', function () {
	return abort(404);
});

Route::get('/', 'PublicHomeController@index');
Route::get('/only_admin_can_see', 'AdminsOnlyController@only_admin_can_see');
Route::get('/everyone', 'AdminsOnlyController@everyone');
Route::get('/prueba', 'PruebaController@prueba');
Route::get('/get_usuarios', 'PublicHomeController@getUsers');

