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

// login administrador
//Route::get('admin', 'Auth\LoginController@loginForm')->name('admin.login');
//lo cambie para hacer el login la pantalla inicial, con la siguiente linea

Route::get('/', 'Auth\LoginController@loginForm')->name('admin.login');
Route::post('admin', 'Auth\LoginController@login');

// proteger rutas con middleware AccessAdmin.php
Route::group(['middleware' => 'auth', 'auth.admin'], function () { 
    Route::get('admin/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('admin/inicio', 'DashboardController@getInicio')->name('admin.inicio');

    //PROCESOS
        //PROYECTOS
        Route::get('admin/load_proyectos', 'proyectosController@load_proyectos');
        Route::get('admin/load_proyectos_aper', 'proyectosController@load_proyectos_aper');
        Route::get('admin/crear_proyecto', 'proyectosController@crear_proyecto');
        Route::get('/admin/ver_proyecto/{id}', 'proyectosController@ver_proyecto');
        //guardar proyecto
        Route::post('admin/add_proyecto', 'proyectosController@add_proyecto');
        Route::post('admin/get_proyecto', 'proyectosController@get_proyecto');
        Route::post('admin/update_proyecto', 'proyectosController@update_proyecto');

            //BITACORAS DE PROYECTO
            Route::post('admin/add_bitacora', 'proyectosController@add_bitacora');
            Route::post('admin/get_bitacora', 'proyectosController@get_bitacora');
            Route::post('admin/update_bitacora', 'proyectosController@update_bitacora');

            //PARTIDAS DE PROYECTO
            Route::post('admin/add_partida', 'proyectosController@add_partida');
            Route::post('admin/get_partida', 'proyectosController@get_partida');
            Route::post('admin/update_partida', 'proyectosController@update_partida');

            Route::get('print-bit/{id}', [ 'as' => 'pdf.bit', 'uses' => 'PdfController@pdf_bitacora' ]);

         //ADMINISTRACION --> CUENTAS BOLSON
            Route::get('admin/bolsones', 'bolsonController@load_bolsones');
            Route::post('admin/addbolson', 'bolsonController@nuevobolson');
            Route::post('admin/infobolson', 'bolsonController@infoBolson');
            Route::post('admin/update_bolson', 'bolsonController@update_bolson');
            Route::post('admin/deletebolson', 'bolsonController@deleteBolson');
        
           //CONFIGURACIONES --> CATALOGO CODIGOS PRESUPUESTARIOS
           Route::get('admin/load_cuentas', 'cuentaController@load_cuentas');
           Route::post('admin/add_cuenta', 'cuentaController@add_cuenta');
           Route::post('admin/get_cuenta', 'cuentaController@get_cuenta');
           Route::post('admin/update_cuenta', 'cuentaController@update_cuenta');
           Route::post('admin/delete_cuenta', 'cuentaController@delete_cuenta');

           //CONFIGURACIONES --> CATALOGO DE MATERIALES
           Route::get('admin/load_materiales', 'materialesController@load_materiales');
           Route::post('admin/add_material', 'materialesController@add_material');
           Route::post('admin/get_material', 'materialesController@get_material');
           Route::post('admin/update_material', 'materialesController@update_material');
           Route::post('admin/delete_material', 'materialesController@delete_material');

           //CONFIGURACIONES --> PROVEEDORES
           Route::get('admin/load_proveedores', 'materialesController@load_proveedores');
           Route::post('admin/add_proveedor', 'materialesController@add_proveedor');
           Route::post('admin/get_proveedor', 'materialesController@get_proveedor');
           Route::post('admin/update_proveedor', 'materialesController@update_proveedor');
           Route::post('admin/delete_proveedor', 'materialesController@delete_proveedor');

           //CONFIGURACIONES --> Linea de trabajo
           Route::get('admin/load_linea', 'configController@load_linea');
           Route::post('admin/add_linea', 'configController@add_linea');
           Route::post('admin/get_linea', 'configController@get_linea');
           Route::post('admin/update_linea', 'configController@update_linea');
           Route::post('admin/delete_linea', 'configController@delete_linea');

           //CONFIGURACIONES --> Fuente de Financiamiento
           Route::get('admin/load_fuentef', 'configController@load_fuentef');
           Route::post('admin/add_fuentef', 'configController@add_fuentef');
           Route::post('admin/get_fuentef', 'configController@get_fuentef');
           Route::post('admin/update_fuentef', 'configController@update_fuentef');
           Route::post('admin/delete_fuentef', 'configController@delete_fuentef');

           //CONFIGURACIONES --> Fuente de Recursos
           Route::get('admin/load_fuenter', 'configController@load_fuenter');
           Route::post('admin/add_fuenter', 'configController@add_fuenter');
           Route::post('admin/get_fuenter', 'configController@get_fuenter');
           Route::post('admin/update_fuenter', 'configController@update_fuenter');
           Route::post('admin/delete_fuenter', 'configController@delete_fuenter');

           //CONFIGURACIONES --> Area de Gestion
           Route::get('admin/load_areagestion', 'configController@load_areagestion');
           Route::post('admin/add_areagestion', 'configController@add_areagestion');
           Route::post('admin/get_areagestion', 'configController@get_areagestion');
           Route::post('admin/update_areagestion', 'configController@update_areagestion');
           Route::post('admin/delete_areagestion', 'configController@delete_areagestion');

           //Generacion de PDFs
           //pdf reforma_apertura
           Route::get('admin/pdf_reforma_apertura/{id}', 'PdfController@pdf_reforma_apertura');


    //INFORMACION DE USUARIOS
    Route::get('/admin/editarusuario', 'UserController@index')->name('admin.EditarUsuario');
    Route::post('/admin/actualizar-usuario','UserController@update');
    Route::get('admin/logout', 'Auth\LoginController@logout');
});