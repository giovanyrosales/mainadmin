<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\materiales;
use App\cuenta;


class materialesController extends Controller
{
   // retornar materiales
  public function load_materiales(){
    $materiales = materiales::All();
    $cuentas = cuenta::All();
     return view('backend.paginas.Materiales',compact('materiales','cuentas'));
 }

   // get material para actualizar
   public function get_material(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('materiales')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'material' => $datos
            ];
        }else{
            return [
                'success' => 2 // Material no encontrado                   
            ];
            }
        }
    }

    // agregar nuevo material
   public function add_material(Request $request){ 
    if($request->isMethod('post')){  
  
       $regla = array( 
           'cod' => 'required',           
           'nombre' => 'required',
           'unidad' => 'required',
           'pu' => 'required'
            );

       $mensaje = array(
           'cod.required' => 'Codigo requerido',
           'nombre.required' => 'Nombre requerido',
           'unidad.required' => 'unidad de medida requerido',
           'pu.required' => 'Precio Unitario requerido'
           );

       $validar = Validator::make($request->all(), $regla, $mensaje );

       if ($validar->fails())
       {
           return [
               'success' => 0, 
               'message' => $validar->errors()->all()
           ];
       }   

        $crearmaterial = materiales::insertGetId([
       'cod'=>$request->cod,
       'nombre'=>$request->nombre,
       'unidad'=>$request->unidad,
       'pu'=>$request->pu,
       'clasificacion'=>$request->clasificacion]); 

       if($crearmaterial){               
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

// Actualizar material
public function update_Material(Request $request){

    if($request->isMethod('post')){  

        if($cuenta = DB::table('materiales')->where('id', $request->id)->first()){                        
            
                DB::table('materiales')->where('id', '=', $request->id)->update(['cod' => $request->cod,
                'nombre' => $request->nombre, 'unidad' => $request->unidad, 'pu' => $request->pu, 'clasificacion' => $request->clasificacion ]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
            }
        }else{
            return [
                'success' => 3 //Material no encontrado
            ];
        }
}

  // eliminar un material
  public function delete_material(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('materiales')->where('id', $request->id)->first()){
            DB::table('materiales')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // Material eliminado          
            ];
        }else{
            return [
                'success' => 2 // Material no encontrado              
            ];
        }
    }
}

}
