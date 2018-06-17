<?php


Route::get('/', function () {
    return view('auth/login');
});

//Luego podremos hacer una prueba para ver que todo este bien, agregando una ruta nueva en el archivo web.php en el directorio routes (routes/web.php):
Route::get('/testmp', function(){
    $mp = new \MP ("1705553029705790", "GRjYlJNkVvkdIVcw3NWxF9fvrOqrj246");
    $access_token = $mp->get_access_token();
    print_r($access_token);
});


Route::get('/welcome', 'FrontController@index');
Route::resource('cart','CartController');

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

