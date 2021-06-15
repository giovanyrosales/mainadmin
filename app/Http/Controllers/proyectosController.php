<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\proyecto;
use App\materiales;
use App\cuenta; //Revisar las que nose usann
use App\bolson;
use App\areagestion;
use App\fuentef;
use App\fuenter;
use App\linea;
use App\bitacora;
use App\requisicion;
use App\deta_requisicion;
use App\bitfotos;
use App\materiales_proy;
use App\cotizacion;
use App\det_cotizacion;
use App\proveedor;




//Definir zona horaria o region.
date_default_timezone_set('America/El_Salvador');
setlocale(LC_ALL,"es_ES");

class proyectosController extends Controller
{
  // retornar vista 
  public function load_proyectos(){
    //para cargar los proyectos
    $proyectos = proyecto::all();
    $cuentas = cuenta::all();
    $bolsones = bolson::all();
    $lineas = linea::all();
    $areasgestion = areagestion::all();
    $fuentesf = fuentef::all();
    $fuentesr = fuenter::all();
     return view('backend.paginas.Proyectos',compact('proyectos','cuentas','bolsones', 'lineas', 'areasgestion', 'fuentesf', 'fuentesr'));
 }

  // retornar vista 
  public function load_proyectos_aper(){
    //Ver los proyectos para generar reformas de apertura
     $proyectos = proyecto::all();
     return view('backend.paginas.Reformas_Aper',compact('proyectos'));
}

 // get proyecto para actualizar
 public function get_proyecto(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('proyecto')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'proyecto' => $datos
            ];
        }else{
            return [
                'success' => 2 // Proyecto no encontrado                   
            ];
            }
        }
    }

 // retornar ver proyecto 
 public function ver_proyecto(Request $dato){
    //para cargar un proyecto
    $proyecto = DB::table('proyecto')->where('id', $dato->id)->first();
    $bitacoras = DB::table('bitacora')->where('proyecto_id', $dato->id)->get();
    $requisiciones = DB::table('requisicion')->where('proyecto_id', $dato->id)->get();
    //$materiales = materiales::all();
     return view('backend.paginas.Ver_proyecto',compact('proyecto','bitacoras','requisiciones'));
 }
    // Actualizar Proyecto
public function update_proyecto(Request $request){

    if($request->isMethod('post')){  

        if($cuenta = DB::table('proyecto')->where('id', $request->id)->first()){                        
            
                DB::table('proyecto')->where('id', '=', $request->id)->update(['codigo' => $request->codigo, 'nombre' => $request->nombre,
                'ubicacion' => $request->ubicacion,'naturaleza' => $request->naturaleza,'areagestion' => $request->areagestion,'linea' => $request->linea,
                'fuentef' => $request->fuentef,'fuenter' => $request->fuenter,'contraparte' => $request->contraparte,'codcontable' => $request->codcontable,
                'fechaini' => $request->fechaini,'ejecutor' => $request->ejecutor,'formulador' => $request->formulador,'supervisor' => $request->supervisor,
                'encargado' => $request->encargado,'bolson_id' => $request->bolson_id,'monto' => $request->monto ]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
             
        }else{
            return [
                'success' => 2 //proyecto no encontrado
            ];
        }
    }
}
  
 // retornar vista  crear proyecto
  public function crear_proyecto(){
    $cuentas = cuenta::all();
    $bolsones = bolson::all();
    $lineas = linea::all();
    $areasgestion = areagestion::all();
    $fuentesf = fuentef::all();
    $fuentesr = fuenter::all();

     return view('backend.paginas.Nuevo_Proyecto',compact('cuentas','bolsones', 'lineas', 'areasgestion', 'fuentesf', 'fuentesr'));
 }
    
 // guardar nuevo proyecto
  public function add_proyecto(Request $request){ 
      if($request->isMethod('post')){  
    
         $regla = array( 
             'nombre' => 'required',           
             'ubicacion' => 'required'
         );

         $mensaje = array(    
             'nombre.required' => 'nombre es requerido',           
             'ubicacion.required' => 'ubicacion es requerido'
         
             );

         $validar = Validator::make($request->all(), $regla, $mensaje );

         if ($validar->fails())
         {
             return [
                 'success' => 0, 
                 'message' => $validar->errors()->all()
             ];
         }   

          $idproyecto = proyecto::insertGetId([
         'codigo'=>$request->codigo,
         'nombre'=>$request->nombre,
         'ubicacion'=>$request->ubicacion,
         'fuentef'=>$request->fuentef,
         'contraparte'=>$request->contraparte,
         'fechaini'=>$request->fechaini,
         'fecha'=>date('Y-m-d'),
         'areagestion'=>$request->areagestion,
         'linea'=>$request->linea,
         'fuenter'=>$request->fuenter,
         'naturaleza'=>$request->naturaleza,
         'ejecutor'=>$request->ejecutor,
         'formulador'=>$request->formulador,
         'supervisor'=>$request->supervisor,
         'encargado'=>$request->encargado,
         'codcontable'=>$request->codcontable,
         'acuerdoapertura'=>$request->acuerdoapertura]); 
         if($idproyecto){     
             $proyecto_id = DB::getPdo()->lastInsertId();
             }

         if($idproyecto){               
             return [
                 'success' => 1,
                 'idproyecto' => $proyecto_id// si
             ];
        }else{
            return [
                'success' => 2 // no se
            ];
        }

     }
 }

/******************************Agregar Requisicion nueva */
 public function add_requisicion(Request $request){ 
    if($request->isMethod('post')){  
  
       $regla = array( 
           'proyecto_id' => 'required',     
           'destino' => 'required',
           'fecha' => 'required',
           'necesidad' => 'required'
       );

       $mensaje = array(
           'proyecto_id.required' => 'Proyecto_id es requerido',
           'fecha.required' => 'Fecha es requerida'
           );

       $validar = Validator::make($request->all(), $regla, $mensaje );

       if ($validar->fails())
       {
           return [
               'success' => 0, 
               'message' => $validar->errors()->all()
           ];
       }   

        $idrequisicion = requisicion::insertGetId([
       'destino'=>$request->destino,
       'fecha'=>$request->fecha,
       'necesidad'=>$request->necesidad,
       'proyecto_id'=>$request->proyecto_id]); 
       if($idrequisicion){     
           $requisicion_id = DB::getPdo()->lastInsertId();
           for ($i = 0; $i < count($request->unidadmedida); $i++) {
               $detalle_requisicion = deta_requisicion::insertGetId([
               'requisicion_id'=>$requisicion_id,
               'unidadmedida'=>$request->unidadmedida[$i],
               'cantidad'=>$request->cantidad[$i],
               'descripcion'=>$request->descripcion[$i]]);
            }
       }
      
       if($detalle_requisicion){               
           return [
               'success' => 1,
               'requisicion_id' => $requisicion_id// si
           ];
                    }else{
                        return [
                            'success' => 2 // no se
                        ];
                     }

                 }
        }
        // get Req para actualizar
 public function get_requisicion(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('requisicion')->where('id', $request->id)->first()){
            $datosdetalle = DB::table('det_requisicion')->where('requisicion_id', $datos->id)->get();
            //foreach ($datosdetalle as $dat){
            //    $nombre = DB::Table('materiales')->where('id', $dat->material_id)->first();
            //    $dat->nombrematerial = $nombre->nombre; 
            //}
            return [
                'success' => 1,
                'requisicion' => $datos,
                'datosdetalle' => $datosdetalle
            ];
        }else{
            return [
                'success' => 2 // Partida no encontrado                   
            ];
            }
        }
    }
            // Actualizar Requisicion
        public function update_requisicion(Request $request){
            if($request->isMethod('post')){

                if($requisicion = DB::table('requisicion')->where('id', $request->id)->first()){                        
                    
                        DB::table('requisicion')->where('id', '=', $request->id)->update(['destino' => $request->destinop,
                        'necesidad' => $request->necesidadp ]);

                        //si se eliminaron filas de la requisicion
                        if(count($request->todelete) > 0){
                            for ($i = 0; $i < count($request->todelete); $i++) {
                                    if($datos = DB::table('det_requisicion')->where('id', $request->todelete[$i])->first()){
                                        // borrar una fuente de financiamiento
                                        DB::table('det_requisicion')->where('id', $request->todelete[$i])->delete();
                                    }
                                }
                        }
                        
                        for ($i = 0; $i < count($request->cantidad); $i++) {
                           if($det_requisicion = DB::table('det_requisicion')->where('id', $request->iddet[$i])->first()){
                                DB::table('det_requisicion')->where('id', '=', $request->iddet[$i])->update(['cantidad' => $request->cantidad[$i],
                                'descripcion' => $request->descripcion[$i],
                                'unidadmedida' => $request->unidadmedida[$i]]);
                           }else{
                                $det_requisicion = deta_requisicion::insertGetId([    
                                'requisicion_id'=>$requisicion->id,                            
                                'cantidad'=>$request->cantidad[$i],
                                'unidadmedida'=>$request->unidadmedida[$i],
                                'descripcion'=>$request->descripcion[$i]]);
                                }
                        }                        
                        return [
                            'success' => 1 // datos guardados correctamente
                        ];                    
                    }
                }else{
                    return [
                        'success' => 3 //requisicion no encontrado
                    ];
                }
        }
//-----------efra get requisiciones onlist of id-----------//
        
public function get_requisiciones_on_list(Request $request){
        
    if($items = DB::table('det_requisicion')->wherein('id', $request->lista)->get()){
        
        return  $items;
    }else{
        return [
            'success' => 2 //ningun item encontrado
        ];
    }
}

/******************************Cotizaciones*/

/****************************Procesar Cotizaciones*/
public function procesar_cotizacion(Request $request){ 
    if($request->isMethod('post')){
        if($cotizacion = DB::table('cotizacion')->where('id', $request->cotizacion_id)->first()){                        
            
                DB::table('cotizacion')->where('id', '=', $request->cotizacion_id)->update(['estado' => $request->estado]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
            }
        }else{
            return [
                'success' => 3 //Cotizacion no encontrada
            ];
        }
}

/****************************Actualizar Cotizaciones*/
public function update_cotizacion(Request $request){ 
    if($request->isMethod('post')){
        if($cotizacion = DB::table('cotizacion')->where('id', $request->cotizacion_id)->first()){                        
            
                DB::table('cotizacion')->where('id', '=', $request->cotizacion_id)->update(['fecha' => $request->fecha]);
                
                for ($i = 0; $i < count($request->cantidad); $i++) {

                   if($det_cotizacion = DB::table('det_cotizacion')->where('id', $request->detallecotid[$i])->first()){
                        DB::table('det_cotizacion')->where('id', '=', $request->detallecotid[$i])
                        ->update([
                            'cantidad' => $request->cantidad[$i],
                            'descripcion' => $request->descripcion[$i],
                            'preciounit' => $request->preciounitario[$i],
                            'cod_presup' => $request->codpresup[$i]
                        ]);
                   }else{
                            return [
                                'success' => 2 // detalles no encontrados
                            ];  
                        }
                }
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
            }
        }else{
            return [
                'success' => 3 //Cotizacion no encontrada
            ];
        }
}


/****************************Ver Cotizaciones*/
public function ver_cotizacion(Request $request){ 
        if($cotizacion = DB::Table('cotizacion')
                                ->join('proveedores', 'cotizacion.proveedor_id', '=', 'proveedores.id')
                                ->join('requisicion', 'cotizacion.requisicion_id', '=', 'requisicion.id')
                                ->join('proyecto', 'requisicion.proyecto_id', '=', 'proyecto.id')
                                ->where('cotizacion.id', $request->id)
                                ->select('cotizacion.*', 'proveedores.nombre as proveedor_nombre', 'proyecto.codigo as proyecto_cod')
                                ->first()){
            $detcotizacion = DB::table('det_cotizacion')->where('cotizacion_id', $cotizacion->id)->get();
           
            return view('backend.paginas.CotizacionesVerEditar',compact('cotizacion' ,'detcotizacion'));
        }else{
            return [
                'success' => 2 // Cotizacion no encontrado                   
            ];
        }
    return view('backend.paginas.CotizacionVerEditar',compact('cotizaciones_pendientes'));
}

/****************************Cargar Cotizaciones Pendientes */
public function load_cotizaciones_pendientes(){ 
    $cotizaciones_pendientes = DB::table('cotizacion')
    ->join('proveedores', 'cotizacion.proveedor_id', '=', 'proveedores.id')
    ->join('requisicion', 'cotizacion.requisicion_id', '=', 'requisicion.id')
    ->join('proyecto', 'requisicion.proyecto_id', '=', 'proyecto.id')
    ->select('cotizacion.*', 'proveedores.nombre as proveedor_nombre', 'proyecto.codigo as proyecto_cod')
    ->where('cotizacion.estado', '=', '0')
    ->get();
    return view('backend.paginas.CotizacionesPendientes',compact('cotizaciones_pendientes'));

}
public function load_cotizaciones_procesadas(){ 
    $cotizaciones_procesadas = DB::table('cotizacion')
    ->join('proveedores', 'cotizacion.proveedor_id', '=', 'proveedores.id')
    ->join('requisicion', 'cotizacion.requisicion_id', '=', 'requisicion.id')
    ->join('proyecto', 'requisicion.proyecto_id', '=', 'proyecto.id')
    ->select('cotizacion.*', 'proveedores.nombre as proveedor_nombre', 'proyecto.codigo as proyecto_cod')
    ->where('cotizacion.estado', '!=', '0')
    ->get();
    return view('backend.paginas.CotizacionesProcesadas',compact('cotizaciones_procesadas'));

}
public function guardar_cotizacion(Request $request){
    if($request->isMethod('post')){  
        $regla = array( 
            'destino' => 'required',     
            'fecha' => 'required',
            'necesidad' => 'required',
            'proveedor_id' => 'required',
            'requisicion_id' => 'required',
            'estado' => 'required'
        );
        $mensaje = array(
            'destino.required' => 'Proyecto_id es requerido',
            'fecha.required' => 'Fecha es requerida',
            'proveedor_id.required' => 'Proveedor_id es requerido',
            'requisicion_id.required' => 'Requisicion_id es requerido',
            'estado.required' => 'Estado es requerido'
        );
        $validar = Validator::make($request->all(), $regla, $mensaje );
        if ($validar->fails())
        {
            return [
                'success' => 0, 
                'message' => $validar->errors()->all()
            ];
        }
        $nuevacotizacion = cotizacion::insertGetId([
            'destino'=>$request->destino,
            'fecha'=>$request->fecha,
            'necesidad'=>$request->necesidad,
            'proveedor_id'=>$request->proveedor_id,
            'requisicion_id'=>$request->requisicion_id,
            'estado' => $request->estado    
        ]); 
        if($nuevacotizacion){ 
            $cotizacion_id = DB::getPdo()->lastInsertId();
            for ($i = 0; $i < count($request->unidadmedida); $i++) {
                $detalle_cotizacion = det_cotizacion::insertGetId([
                'cantidad'=>$request->cantidad[$i],
                'unidadmedida'=>$request->unidadmedida[$i],
                'descripcion'=>$request->descripcion[$i],
                'preciounit'=>$request->preciounitario[$i],
                'cod_presup'=>$request->codpresup[$i],
                'cotizacion_id'=>$cotizacion_id
                ]);
                $affected = DB::table('det_requisicion')->where('id', $request->detallereqid[$i])->update(['estado' => "1"]);

             }

            if($detalle_cotizacion){               
                return [
                    'success' => 1,
                    'cotizacion_id' => $cotizacion_id// inserccion de detalles satisfactoria
                ];
            }else{
                return [
                    'success' => 2 // error de inserccion de detalles cotizacion
                ];
            }
        }else{
            return [
                'success' => 2 // error de inserccion de cotizacion
            ];
        }
 
                  
    }

}
public function crear_cotizacion_vista(Request $request){
    if ($request->isMethod('get')){
        if($requisicion = DB::Table('requisicion')->where('id', $request->id)->first()){
            if($requisicion_det = DB::table('det_requisicion')->where('requisicion_id', $requisicion->id)->where('estado','0' )->get()){
                if($proveedores = proveedor::all()){
                    
                    return view('backend.paginas.CotizacionesCrearCotizacion', compact('requisicion','requisicion_det','proveedores'));             
                }else {
                    return [
                        'success' => 2 // No existen proveedores                  
                    ]; 
                }
            }else {
                return [
                    'success' => 2 // Detalles de requisicion no encontrados                  
                ]; 
            }
        }else{
            return [
                'success' => 2 // Requisicion no encontrada                  
            ]; 
        }
    }
}
}
