<?php


Route::get('/', function () {
    return view('auth/login');
});

Route::resource('ventas/cliente','ClienteController');
Route::resource('compras/proveedor','ProveedorController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('ventas/venta','VentaController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('almacen/categoria','CategoriaController');
Route::resource('seguridad/usuario','UsuarioController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout','Auth\LoginController@logout');
//si la ruta no existe
Route::get('/{slug?}','HomeController@index');
