<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::group([
    'middleware'=>['auth','active',] ],
    function(){ 
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/pago', 'HomeController@pago')->name('pago');
    Route::get('/publicidad', 'HomeController@publicidad')->name('publicidad');
    Route::get('/compra', 'HomeController@compra')->name('compra');

    Route::get('user/getJson' , 'UsersController@getJson' )->name('users.getJson');
    Route::get('users' , 'UsersController@index' )->name('users.index');
    Route::post('users' , 'UsersController@store' )->name('users.store');
    Route::get('users/delete/{user}' , 'UsersController@destroy' );
    Route::post('users/update/{user}' , 'UsersController@update' );
    Route::get('users/{user}/edit', 'UsersController@edit' );
    Route::post('users/reset/tercero/{user}' , 'UsersController@resetPasswordTercero');
    Route::post('users/reset' , 'UsersController@resetPassword')->name('users.reset');
    Route::get( '/users/cargar' , 'UsersController@cargarSelect')->name('users.cargar');

    Route::get('vuelos' , 'vueloController@index' )->name('vuelos.index');
    Route::get('vuelos/getJson' , 'vueloController@getJson' )->name('vuelos.getJson');
    Route::post('/vuelos/save' , 'vueloController@store')->name('vuelos.save');
    Route::get('/vuelos/{vuelo}/delete' , 'vueloController@destroy');
    Route::put( '/vuelos/{vuelo}/update' , 'vueloController@update')->name('vuelos.update');
    Route::get( '/paisv/cargar' , 'vueloController@cargarSelect')->name('paisv.cargar');
    Route::get( '/aerolinea/cargar' , 'vueloController@cargaraerolinea')->name('aerolinea.cargar');
    
    //hoteles
    Route::get('hoteles' , 'HotelController@index' )->name('hoteles.index');
    Route::get('hoteles/getJson' , 'HotelController@getJson' )->name('hoteles.getJson');
    Route::post('/hoteles/save' , 'HotelController@store')->name('hoteles.save');
    Route::get('/hoteles/{hotel}/delete' , 'HotelController@destroy');
    Route::put('/hoteles/{hotel}/update' , 'HotelController@update')->name('hoteles.update');
    Route::get('/pais/cargar' , 'HotelController@cargarSelect')->name('pais.cargar');

    //hoteles
    Route::get('aerolineas' , 'AerolineaController@index' )->name('aerolinea.index');
    Route::get('aerolineas/getJson' , 'AerolineaController@getJson' )->name('aerolinea.getJson');
    Route::post('/aerolineas/save' , 'AerolineaController@store')->name('aerolinea.save');
    Route::get('/aerolineas/{aerolinea}/delete' , 'AerolineaController@destroy');
    Route::put('/aerolineas/{aerolinea}/update' , 'AerolineaController@update')->name('aerolinea.update');
    Route::get('/pais/cargar' , 'AerolineaController@cargarSelect')->name('pais.cargar');

    //rutas para habitaciones
    Route::get( '/habitaciones' , 'HabitacionesController@index')->name('habitaciones.index');
    Route::get( '/habitaciones/getJson/' , 'HabitacionesController@getJson')->name('habitaciones.getJson');
    Route::put( '/habitaciones/{habitacion}/update' , 'HabitacionesController@update')->name('habitaciones.update');
    Route::post( '/habitaciones/save' , 'HabitacionesController@store')->name('habitaciones.save');
    Route::post('/habitaciones/{habitacion}/delete' , 'HabitacionesController@destroy');
    Route::get( '/hoteles/cargar' , 'HabitacionesController@cargarSelect')->name('hotel.cargar');


});

Auth::routes();
Route::get('activate/{token}', 'Auth\RegisterController@activate')->name('activate');


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user/get/' , 'Auth\LoginController@getInfo')->name('user.get');
Route::post('/user/contador' , 'Auth\LoginController@Contador')->name('user.contador');
Route::post('/password/reset2' , 'Auth\ForgotPasswordController@ResetPassword')->name('password.reset2');
Route::get('/user-existe/', 'Auth\LoginController@userExiste')->name('user.existe');


Route::group(['middleware' => 'cors', 'prefix' => 'api'], function()
{
    Route::get('/getuser','UsersController@api');
    Route::get('/getpais' , 'apiController@cargarPais');
    Route::get('/getpublicidad' , 'apiController@cargarPublicidad');
    Route::get('/getpaquetes' , 'apiController@cargarPaquetes');
    
    Route::get('/getpaquete/{id}' , 'apiController@cargarPaquete');

    Route::get('/getvuelo/{pais1}/{pais2}/{fecha}' , 'apiController@obtenervuelos');
    Route::get('/gethabitaciones/{pais}/{entrada}/{salida}','apiController@gethabitacion');
    Route::post('/reservar_boleto','apiController@reservar_boleto');
    Route::post('/reservar_hotel','apiController@reservar_hotel');
    Route::post('/compra_paquete','apiController@comprarpaquete');

});