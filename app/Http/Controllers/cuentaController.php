<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\cuenta;

class cuentaController extends Controller
{
     // retornar vista 
  public function load_cuentas(){
    //para cargar las cuentas
     $codigos = cuenta::all();
     return view('backend.paginas.Cuentas',compact('codigos'));
 }

     // obtener informacion un codigo para actualizarla
     public function get_cuenta(Request $request){
        if($request->isMethod('post')){    

            if($datos = DB::Table('cuenta')->where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'cuenta' => $datos
                ];
            }else{
                return [
                    'success' => 2 // cuenta no encontrado                   
                ];
            }
        }
    }

   // agregar nueva cuenta bolson
   public function add_cuenta(Request $request){ 
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

        $crearcod = cuenta::insertGetId([
       'codigo'=>$request->codigo,
       'nombre'=>$request->nombre]); 

       if($crearcod){               
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

// editar codigo presupuestario
public function update_cuenta(Request $request){

    if($request->isMethod('post')){  

        // encontrar codigo a  modificar
        if($cuenta = DB::table('cuenta')->where('id', $request->id)->first()){                        

            
                DB::table('cuenta')->where('id', '=', $request->id)->update(['nombre' => $request->nombre,
                'codigo' => $request->codigo]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
            }
        }else{
            return [
                'success' => 3 //cuenta no encontrada
            ];
        }
}

  // eliminar una cuenta
  public function delete_cuenta(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('cuenta')->where('id', $request->id)->first()){
            // borrar cuenta
            DB::table('cuenta')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // codigo eliminado          
            ];
        }else{
            return [
                'success' => 2 // codigo no encontrado              
            ];
        }
    }
}

}
