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
        Route::get('admin/ver_proyecto/{id}', 'proyectosController@ver_proyecto');
        //guardar proyecto
        Route::post('admin/add_proyecto', 'proyectosController@add_proyecto');
        Route::post('admin/get_proyecto', 'proyectosController@get_proyecto');
        Route::post('admin/update_proyecto', 'proyectosController@update_proyecto');

            //BITACORAS DE PROYECTO
            Route::post('admin/add_bitacora', 'proyectosController@add_bitacora');
            Route::post('admin/get_bitacora', 'proyectosController@get_bitacora');
            Route::post('admin/update_bitacora', 'proyectosController@update_bitacora');

            //REQUISICIONES DE PROYECTO
            Route::post('admin/add_requisicion', 'proyectosController@add_requisicion');
            Route::post('admin/get_requisicion', 'proyectosController@get_requisicion');
            Route::post('admin/update_requisicion', 'proyectosController@update_requisicion');

            Route::get('print-bit/{id}', [ 'as' => 'pdf.bit', 'uses' => 'PdfController@pdf_bitacora' ]);
             //Ruta que devuelve requisiciones en base array de ID (Efra)
             Route::post('admin/get_requisiciones_on_list', 'proyectosController@get_requisiciones_on_list');

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
           Route::get('admin/load_proveedores', 'ProveedorController@load_proveedor');
           Route::post('admin/add_proveedor', 'ProveedorController@add_proveedor');
           Route::post('admin/get_proveedor', 'ProveedorController@get_proveedor');
           Route::post('admin/update_proveedor', 'ProveedorController@update_proveedor');
           Route::post('admin/delete_proveedor', 'ProveedorController@delete_proveedor');

           //CONFIGURACIONES --> ADMINISTRADORES DE CONTRATO
           Route::get('admin/load_admin', 'configController@load_admin');
           Route::post('admin/add_admin', 'configController@add_admin');
           Route::post('admin/get_admin', 'configController@get_admin');
           Route::post('admin/update_admin', 'configController@update_admin');
           Route::post('admin/delete_admin', 'configController@delete_admin');

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

           //COTIZACIONES

            //Cargar Cotizaciones
            Route::get('admin/load_cotizaciones_pendientes', 'proyectosController@load_cotizaciones_pendientes');
            Route::get('admin/load_cotizaciones_procesadas', 'proyectosController@load_cotizaciones_procesadas');
            Route::get('admin/procesar_cotizaciones', 'proyectosController@load_cotizaciones_pendientes');
            

            //Crear Cotizaciones
            Route::get('admin/crear_cotizacion_vista/{id}','proyectosController@crear_cotizacion_vista');
            Route::post('admin/guardar_cotizacion', 'proyectosController@guardar_cotizacion');
            Route::post('admin/update_cotizacion', 'proyectosController@update_cotizacion');

            //Guardar Cotizaciones
            Route::get('admin/ver_cotizacion/{id}', 'proyectosController@ver_cotizacion');
            Route::post('admin/procesar_cotizacion', 'proyectosController@procesar_cotizacion');
            
            
            //ORDENES
            Route::get('admin/load_orden', 'OrdenController@load_orden');
            Route::post('admin/get_cotizacion', 'proyectosController@get_cotizacion');
            Route::post('admin/add_orden', 'OrdenController@add_orden');
            Route::post('admin/get_orden', 'OrdenController@get_orden');
            Route::post('admin/update_orden', 'OrdenController@update_orden');
            Route::post('admin/anular_orden', 'OrdenController@anular_orden');

           //Generacion de PDFs
           //pdf reforma_apertura
           Route::get('admin/pdf_reforma_apertura/{id}', 'PdfController@pdf_reforma_apertura');
           Route::get('pdf_rep_comprasal/{id}', 'PdfController@pdf_rep_comprasal');

           //PDF Orden de Compra
                //desde controlador
           Route::get('admin/pdf_orden/{id}', 'OrdenController@pdf_orden');
                //desde vista
           Route::get('create-item1/{id}', [
            'as' => 'pdf.orden.create', 
            'uses' => 'OrdenController@pdf_orden'
        ]);

         //ACTAS
         Route::get('admin/load_acta', 'ActaController@load_acta');
         Route::post('admin/add_acta', 'ActaController@add_acta');
         Route::post('admin/get_acta', 'ActaController@get_acta');

        //PDF Acta
         //desde controlador
         Route::get('admin/pdf_acta/{id}', 'ActaController@pdf_acta');
         //desde vista
         Route::get('create-item2/{id}', [
             'as' => 'pdf.acta.create', 
             'uses' => 'ActaController@pdf_acta'
         ]);


    //INFORMACION DE USUARIOS
    Route::get('/admin/editarusuario', 'UserController@index')->name('admin.EditarUsuario');
    Route::post('/admin/actualizar-usuario','UserController@update');
    Route::get('admin/logout', 'Auth\LoginController@logout');
});