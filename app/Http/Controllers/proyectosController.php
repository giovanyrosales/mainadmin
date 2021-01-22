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
use App\partida;
use App\deta_partida;
use App\bitfotos;
use App\materiales_proy;



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
    $partidas = DB::table('partida')->where('proyecto_id', $dato->id)->get();
    $materiales = materiales::all();
     return view('backend.paginas.Ver_proyecto',compact('proyecto','bitacoras','partidas', 'materiales'));
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
// agregar nueva Bitacora
public function add_bitacora(Request $request){ 
    if($request->isMethod('post')){  
  
       $regla = array(         
           'fecha' => 'required',
           'proyecto_id' => 'required'
            );

       $mensaje = array(
           'fecha.required' => 'Fecha requerido',
           'proyecto_id.required' => 'Poryecto Requerido'
           );

           $validar = Validator::make($request->all(), $regla, $mensaje );

           if ($validar->fails())
           {
               return [
                   'success' => 0, 
                   'message' => $validar->errors()->all()
               ];
           }   

        $crearbitacora = bitacora::insertGetId([
       'proyecto_id'=>$request->proyecto_id,
       'num'=>$request->num,
       'fecha'=>$request->fecha,
       'observaciones'=>$request->observaciones]); 
       $bitacora_id = DB::getPdo()->lastInsertId();
            
            foreach ($request->file('dir') as $key => $img) {
                
                $cadena = Str::random(8);
                $nombre = str_replace(' ', '_', $cadena);

                $extension = '.'.$img->getClientOriginalExtension();
                $nombreFoto = $nombre.$extension;

                Storage::disk('bitfotos')->put($nombreFoto, \File::get($img));

                // insertar nombre fotografia
                    $bitfotos = bitfotos::insertGetId([
                        'bitacora_id'=>$bitacora_id,
                        'dir'=>$nombreFoto,
                        'nombre'=>$request->titulo[$key]]); 
                }

       if($crearbitacora){               
           return [
               'success' => 1
           ];
      }else{
          return [
              'success' => 2 //
          ];
      }

   }
}
 // get bitacora para actualizar
 public function get_bitacora(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('bitacora')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'bitacora' => $datos
            ];
        }else{
            return [
                'success' => 2 // Bitacora no encontrado                   
            ];
            }
        }
    }

    // Actualizar Bitacora
public function update_bitacora(Request $request){

    if($request->isMethod('post')){  

        if($cuenta = DB::table('bitacora')->where('id', $request->id)->first()){                        
            
                DB::table('bitacora')->where('id', '=', $request->id)->update(['fecha' => $request->fecha,
                'observaciones' => $request->observaciones ]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
            
        }else{
            return [
                'success' => 3 //Bitacora no encontrado
            ];
        }
    }
}

/******************************Agregar partida nueva */
 public function add_partida(Request $request){ 
    if($request->isMethod('post')){  
  
       $regla = array( 
           'proyecto_id' => 'required',     
           'item' => 'required'
       );

       $mensaje = array(
           'proyecto_id.required' => 'Proyecto_id es requerido',
           'item.required' => 'item es requerido'
           );

       $validar = Validator::make($request->all(), $regla, $mensaje );

       if ($validar->fails())
       {
           return [
               'success' => 0, 
               'message' => $validar->errors()->all()
           ];
       }   

        $idpartida = partida::insertGetId([
       'item'=>$request->item,
       'nombre'=>$request->nombre,
       'cantidadp'=>$request->cantidadp,
       'proyecto_id'=>$request->proyecto_id]); 
       if($idpartida){     
           $partida_id = DB::getPdo()->lastInsertId();
           for ($i = 0; $i < count($request->cantidad); $i++) {
               $detalle_partida = deta_partida::insertGetId([
               'partida_id'=>$partida_id,
               'material_id'=>$request->material_id[$i],
               'cantidad'=>$request->cantidad[$i],
               'unidad'=>$request->unidad[$i]]);
            }
       }
       if($detalle_partida){
        for ($i = 0; $i < count($request->material_id); $i++) {
            $materiales_proyecto = materiales_proy::insertGetId([
            'estado'=>'1',
            'cantidad'=>$request->cantidad[$i],
            'material_id'=>$request->material_id[$i],
            'proyecto_id'=>$request->proyecto_id]);
           }
       }
       if($materiales_proyecto){               
           return [
               'success' => 1,
               'partida_id' => $partida_id// si
           ];
                    }else{
                        return [
                            'success' => 2 // no se
                        ];
                     }

                 }
        }
        // get partida para actualizar
 public function get_partida(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('partida')->where('id', $request->id)->first()){
            $datosdetalle = DB::table('detalle_partida')->where('partida_id', $datos->id)->get();
            foreach ($datosdetalle as $dat){
                $nombre = DB::Table('materiales')->where('id', $dat->material_id)->first();
                $dat->nombrematerial = $nombre->nombre; 
            }
            return [
                'success' => 1,
                'partida' => $datos,
                'datosdetalle' => $datosdetalle
            ];
        }else{
            return [
                'success' => 2 // Partida no encontrado                   
            ];
            }
        }
    }
            // Actualizar partida
        public function update_partida(Request $request){

            if($request->isMethod('post')){  

                if($partida = DB::table('partida')->where('id', $request->id)->first()){                        
                    
                        DB::table('partida')->where('id', '=', $request->id)->update(['cantidadp' => $request->cantidadp,
                        'nombre' => $request->nombre ]);
                        
                        for ($i = 0; $i < count($request->material_id); $i++) {
                           if($det_partida = DB::table('detalle_partida')->where('id', $request->iddet[$i])->first()){
                                DB::table('detalle_partida')->where('id', '=', $request->iddet[$i])->update(['cantidad' => $request->cantidad[$i],
                                'material_id' => $request->material_id[$i],
                                'unidad' => $request->unidad[$i]]);
                           }else{
                                $detalle_partida = deta_partida::insertGetId([    
                                'partida_id'=>$partida->id,                            
                                'material_id'=>$request->material_id[$i],
                                'cantidad'=>$request->cantidad[$i],
                                'unidad'=>$request->unidad[$i]]);
                                }
                        }
                        
                        return [
                            'success' => 1 // datos guardados correctamente
                        ];                    
                    }
                }else{
                    return [
                        'success' => 3 //partida no encontrado
                    ];
                }
        }

}
