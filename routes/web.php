<?php

/*Route::get('/main', function () {
    return view('Main content/MainContent');
})->name('main');*/

Route::group(['middleware' => 'guest'], function () {
    /* Login, para todos los usuarios */

    Route::get('/','indexController@showIndex');
    Route::get('/login','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    /* Rutas para los usuarios autenticados */

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    
    Route::get('/main', function () {
        return view('Main content/MainContent');
    })->name('main');
    
    Route::group(['middleware' => 'Administrador'], function () {
        /* Rutas para el usuario Administrador */

        /* Rutas para las promociones */
        Route::get('/promocion', 'promocionController@index');
        Route::post('/promocion/save', 'promocionController@store');
        Route::put('/promocion/update', 'promocionController@update');
        Route::put('/promocion/activate', 'promocionController@activate');
        Route::put('/promocion/desactivate', 'promocionController@desactivate');
        Route::get('/promocion/selectPromocion', 'promocionController@selectPromocion');

        /* Rutas para el pago */
        Route::get('/tipo_pago', 'tipopagoController@index');
        Route::post('/tipo_pago/save','tipopagoController@store');
        Route::put('/tipo_pago/update', 'tipopagoController@update');
        Route::put('/tipo_pago/activate', 'tipopagoController@activate');
        Route::put('/tipo_pago/desactivate', 'tipopagoController@desactivate');
        Route::get('/tipo_pago/selectTipoPago', 'tipopagoController@selectTipoPago');

        /* Rutas para el servicio */
        Route::get('/servicio', 'servicioController@index');
        Route::post('/servicio/save','servicioController@store');
        Route::put('/servicio/update' ,'servicioController@update');
        Route::put('/servicio/activate', 'servicioController@activate');
        Route::put('/servicio/desactivate', 'servicioController@desactivate');
        Route::get('/servicio/listarServicio', 'servicioController@listarServicio');

        /* Rutas para el tipo de habitación */
        Route::get('/tipo_habitacion', 'tipohabitacionController@index');
        Route::post('/tipo_habitacion/save', 'tipohabitacionController@store');
        Route::put('/tipo_habitacion/update', 'tipohabitacionController@update');
        Route::put('/tipo_habitacion/activate', 'tipohabitacionController@activate');
        Route::put('/tipo_habitacion/desactivate', 'tipohabitacionController@desactivate');
        Route::get('/tipo_habitacion/selectTipoHabitacion', 'tipohabitacionController@selectTipoHabitacion');

        /* Rutas para habitación */
        Route::get('/habitacion', 'habitacionController@index');
        Route::post('/habitacion/save', 'habitacionController@store');
        Route::put('/habitacion/update', 'habitacionController@update');
        Route::put('/habitacion/activate', 'habitacionController@activate');
        Route::put('/habitacion/desactivate', 'habitacionController@desactivate');
        Route::put('/habitacion/available', 'habitacionController@available');
        Route::get('/habitacion/listarHabitacion', 'habitacionController@listarHabitacion');

        /* Rutas para usuario */
        Route::get('/rol/selectRol', 'rolController@selectRol');
        Route::get('/users', 'UserController@index');
        Route::post('/users/save', 'UserController@store');
        Route::put('/users/update', 'UserController@update');
        Route::put('/users/activate', 'UserController@activate');
        Route::put('/users/desactivate', 'UserController@desactivate');

        /* Rutas para reserva */
        Route::get('/reserva', 'reservaController@index');
        Route::post('/reserva/save', 'reservaController@store');
        Route::put('/reserva/update', 'reservaController@update');
        Route::put('/reserva/checkIn', 'reservaController@checkIn');
        Route::put('/reserva/checkOut', 'reservaController@checkOut');
        Route::get('/reserva/obtenerCabecera', 'reservaController@obtenerCabecera');
        Route::get('/reserva/obtenerDetalle', 'reservaController@obtenerDetalle');
        Route::put('/reserva/desactivate', 'reservaController@desactivate');
        Route::get('/reserva/pdf/{id}', 'reservaController@pdf')->name('reserva_pdf');

        /* Rutas para el pago */
        Route::get('/pago/Pago', 'pagoController@Pago');
        Route::post('/pago/save', 'pagoController@store');
    });

    Route::group(['middleware' => 'Recepcionista'], function () {
        /* Rutas para el usuario Recepcionista */

        /* Ruta para hacer el pago de la reservación */
        Route::get('/tipo_pago/selectTipoPago', 'tipopagoController@selectTipoPago');

        /* Rutas para habitación */
        Route::get('/habitacion', 'habitacionController@index');
        Route::post('/habitacion/save', 'habitacionController@store');
        Route::put('/habitacion/update', 'habitacionController@update');
        Route::put('/habitacion/activate', 'habitacionController@activate');
        Route::put('/habitacion/desactivate', 'habitacionController@desactivate');
        Route::put('/habitacion/available', 'habitacionController@available');
        
        /* Rutas para reserva */
        Route::get('/reserva', 'reservaController@index');
        Route::post('/reserva/save', 'reservaController@store');
        Route::put('/reserva/update', 'reservaController@update');
        Route::put('/reserva/checkIn', 'reservaController@checkIn');
        Route::put('/reserva/checkOut', 'reservaController@checkOut');
        Route::get('/reserva/obtenerCabecera', 'reservaController@obtenerCabecera');
        Route::get('/reserva/obtenerDetalle', 'reservaController@obtenerDetalle');
        Route::put('/reserva/desactivate', 'reservaController@desactivate');
        Route::get('/reserva/pdf/{id}', 'reservaController@pdf')->name('reserva_pdf');

        /* Rutas para el pago */
        Route::get('/pago/Pago', 'pagoController@Pago');
        Route::post('/pago/save', 'pagoController@store');
    });

    Route::group(['middleware' => 'Guest'], function () {
        /* Rutas para el usuario Guest */

        Route::post('/reserva/save_guest', 'reservaController@store_guest');
    });
});
