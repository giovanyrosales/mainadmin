<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\fuentef;
use App\fuenter;
use App\linea;
use App\areagestion;
use App\admin_contrato;

class configController extends Controller
{
     // retornar lineas 
  public function load_linea(){
    //para cargar los proyectos
    $lineas = linea::all();
     return view('backend.paginas.Lineas',compact('lineas'));
 }
  // retornar fuentesf
  public function load_fuentef(){
    //para cargar los proyectos
    $fuentesf = fuentef::all();
     return view('backend.paginas.Fuentesf',compact('fuentesf'));
 }
  // retornar fuentesr 
  public function load_fuenter(){
    //para cargar los proyectos
    $fuentesr = fuenter::all();
    $fuentesf = fuentef::all();
     return view('backend.paginas.Fuentesr',compact('fuentesr', 'fuentesf'));
 }
  // retornar areasgestion 
  public function load_areagestion(){
    //para cargar los proyectos
    $areasgestion = areagestion::all();
    $lineas = linea::all();
     return view('backend.paginas.AreasGestion',compact('areasgestion','lineas'));
 }
 // retornar Administradores de Contrato 
 public function load_admin(){
    //para cargar los administradores
    $admins_contrato = admin_contrato::all();
     return view('backend.paginas.Admins_contrato',compact('admins_contrato'));
 }
   // obtener info de una linea
   public function get_linea(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('linea')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'linea' => $datos
            ];
        }else{
            return [
                'success' => 2 // linea no encontrado                   
            ];
        }
    }
}
//**************************************************  LINEA DE TRABAJO ************************************/
   // agregar nueva Linea de trabajo
   public function add_linea(Request $request){ 
    if($request->isMethod('post')){  
  
       $regla = array( 
           'codigo' => 'required',           
           'nombre' => 'required',
            );

       $mensaje = array(
           'codigo.required' => 'Codigo requerido',
           'nombre.required' => 'Nombre requerido'
           );

       $validar = Validator::make($request->all(), $regla, $mensaje );

       if ($validar->fails())
       {
           return [
               'success' => 0, 
               'message' => $validar->errors()->all()
           ];
       }   

        $crearlinea = linea::insertGetId([
       'codigo'=>$request->codigo,
       'nombre'=>$request->nombre]); 

       if($crearlinea){               
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
// editar linea de trabajo
public function update_linea(Request $request){

    if($request->isMethod('post')){  

        // encontrar linea de trabajo a modificar
        if($linea = DB::table('linea')->where('id', $request->id)->first()){                        

            
                DB::table('linea')->where('id', '=', $request->id)->update(['nombre' => $request->nombre,
                'codigo' => $request->codigo]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
            
        }else{
            return [
                'success' => 3 //linea de trabajo no encontrada
            ];
        }
    }
}
      // eliminar una linea de trabajo
  public function delete_linea(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('linea')->where('id', $request->id)->first()){
            // borrar linea de trabajo
            DB::table('linea')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // linea de trabajo eliminado          
            ];
        }else{
            return [
                'success' => 2 // linea de trabajo no encontrado              
            ];
        }
    }
}
//**************************************************  AREA DE GESTION  ************************************/
// obtener info de una area de gestion
public function get_areagestion(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('areagestion')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'areagestion' => $datos
            ];
        }else{
            return [
                'success' => 2 // area de gestion no encontrado                   
            ];
        }
    }
}
   // agregar nueva Area de gestion
   public function add_areagestion(Request $request){ 
    if($request->isMethod('post')){  
  
       $regla = array( 
           'linea_id' => 'required',
           'codigo' => 'required',           
           'nombre' => 'required',
            );

       $mensaje = array(
           'linea_id.required' => 'Linea de Trabajo Requerida',
           'codigo.required' => 'Codigo requerido',
           'nombre.required' => 'Nombre requerido'
           );

       $validar = Validator::make($request->all(), $regla, $mensaje );

       if ($validar->fails())
       {
           return [
               'success' => 0, 
               'message' => $validar->errors()->all()
           ];
       }   

        $creararea = areagestion::insertGetId([
            'linea_id'=>$request->linea_id,
            'codigo'=>$request->codigo,
            'nombre'=>$request->nombre]); 

       if($creararea){               
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
// editar area de gestion
public function update_areagestion(Request $request){

    if($request->isMethod('post')){  

        // encontrar area a modificar
        if($area = DB::table('areagestion')->where('id', $request->id)->first()){                        

            
                DB::table('areagestion')->where('id', '=', $request->id)->update(['nombre' => $request->nombre, 'linea_id' => $request->linea_id,
                'codigo' => $request->codigo]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
            
        }else{
            return [
                'success' => 3 //linea de trabajo no encontrada
            ];
        }
    }
}
      // eliminar una area de gestion
  public function delete_areagestion(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('areagestion')->where('id', $request->id)->first()){
            // borrar una area de gestion
            DB::table('areagestion')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // area de gestion eliminada       
            ];
        }else{
            return [
                'success' => 2 // area de gestion no encontrado              
            ];
        }
    }
}
//**************************************************  FUENTE DE FINANCIAMIENTO  ************************************/
// obtener info de una fuente de financiamiento
public function get_fuentef(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('fuentef')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'fuentef' => $datos
            ];
        }else{
            return [
                'success' => 2 // fuentef no encontrado                   
            ];
        }
    }
}
   // agregar nueva Area de gestion
   public function add_fuentef(Request $request){ 
    if($request->isMethod('post')){  
  
       $regla = array( 
           'codigo' => 'required',           
           'nombre' => 'required',
            );

       $mensaje = array(
           'codigo.required' => 'Codigo requerido',
           'nombre.required' => 'Nombre requerido'
           );

       $validar = Validator::make($request->all(), $regla, $mensaje );

       if ($validar->fails())
       {
           return [
               'success' => 0, 
               'message' => $validar->errors()->all()
           ];
       }   

        $creafuentef = fuentef::insertGetId([
            'codigo'=>$request->codigo,
            'nombre'=>$request->nombre]); 

       if($creafuentef){               
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
    // editar fuente de financiamiento
public function update_fuentef(Request $request){

    if($request->isMethod('post')){  

        // encontrar fuentef a modificar
        if($area = DB::table('fuentef')->where('id', $request->id)->first()){                        

            
                DB::table('fuentef')->where('id', '=', $request->id)->update(['nombre' => $request->nombre,
                'codigo' => $request->codigo]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
            
        }else{
            return [
                'success' => 3 //linea de trabajo no encontrada
            ];
        }
    }
}
      // eliminar una area de gestion
  public function delete_fuentef(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('fuentef')->where('id', $request->id)->first()){
            // borrar una fuente de financiamiento
            DB::table('fuentef')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // fuente de financiamiento eliminada       
            ];
        }else{
            return [
                'success' => 2 // fuentef no encontrado              
            ];
        }
    }
}
//**************************************************  FUENTE DE RECURSOS ************************************/
// obtener info de una fuente de recursos
public function get_fuenter(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('fuenter')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'fuenter' => $datos
            ];
        }else{
            return [
                'success' => 2 // fuenter no encontrado                   
            ];
        }
    }
}
   // agregar nueva fuente de recursos
   public function add_fuenter(Request $request){ 
    if($request->isMethod('post')){  
  
       $regla = array( 
           'fuentef_id' => 'required',
           'codigo' => 'required',           
           'nombre' => 'required',
            );

       $mensaje = array(
           'fuentef_id.required' => 'Fuente de Financiamiento Requerida',
           'codigo.required' => 'Codigo requerido',
           'nombre.required' => 'Nombre requerido'
           );

       $validar = Validator::make($request->all(), $regla, $mensaje );

       if ($validar->fails())
       {
           return [
               'success' => 0, 
               'message' => $validar->errors()->all()
           ];
       }   

        $crearfuenter = fuenter::insertGetId([
            'fuentef_id'=>$request->fuentef_id,
            'codigo'=>$request->codigo,
            'nombre'=>$request->nombre]); 

       if($crearfuenter){               
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
    // editar fuente de recursos
public function update_fuenter(Request $request){

    if($request->isMethod('post')){  

        // encontrar fuenter a modificar
        if($area = DB::table('fuenter')->where('id', $request->id)->first()){                        

            
                DB::table('fuenter')->where('id', '=', $request->id)->update(['nombre' => $request->nombre, 'fuentef_id' => $request->fuentef_id,
                'codigo' => $request->codigo]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
        
         }else{
            return [
                'success' => 3 //fuente de recursos no encontrada
            ];
        }
    }
}
      // eliminar una fuente de recursos
  public function delete_fuenter(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('fuenter')->where('id', $request->id)->first()){
            // borrar una fuente de financiamiento
            DB::table('fuenter')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // fuenter eliminada       
            ];
        }else{
            return [
                'success' => 2 // fuenter no encontrada              
            ];
            }
        }
    }
    //**************************************************  Administradores de contrato ************************************/
// obtener info de un administrador de contrato
public function get_admin(Request $request){
    if($request->isMethod('post')){    

            if($datos = DB::Table('admin_contrato')->where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'admin' => $datos
                ];
            }else{
                return [
                    'success' => 2 // administrador no encontrado                   
                ];
            }
        }
    }
    // agregar nuevo administrador de contrato
public function add_admin(Request $request){ 
    if($request->isMethod('post')){  

    $regla = array( 
        'nombre' => 'required'
            );

    $mensaje = array(
        'nombre.required' => 'Nombre requerido'
        );

    $validar = Validator::make($request->all(), $regla, $mensaje );

        if ($validar->fails())
        {
            return [
                'success' => 0, 
                'message' => $validar->errors()->all()
            ];
        }   

            $crearadmin = admin_contrato::insertGetId([            
                'nombre'=>$request->nombre,
                'telefono'=>$request->telefono]); 

        if($crearadmin){               
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
    // editar administrador de contrato
public function update_admin(Request $request){

    if($request->isMethod('post')){  

        // encontrar administrador de contrato
        if($area = DB::table('admin_contrato')->where('id', $request->id)->first()){                        
            
                DB::table('admin_contrato')->where('id', '=', $request->id)->update(['nombre' => $request->nombre,'telefono' => $request->telefono]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
            } else {
            return [
                'success' => 3 //administrador de contrato no encontrada
            ];
        }
     }
	}
    // eliminar un admin de contrato
  public function delete_admin(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('admin_contrato')->where('id', $request->id)->first()){
            // borrar un admin
            DB::table('admin_contrato')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // admin eliminado  
            ];
        }else{
            return [
                'success' => 2 // admin no encontrado
            ];
            }
        }
    }
}

