<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\proveedor;

class ProveedorController extends Controller
{
  //**************************************************  PROVEEDORES  ************************************/
   // retornar proveedores
   public function load_proveedor(){
    //para cargar los proveedores
    $proveedores = proveedor::all();
     return view('backend.paginas.Proveedores',compact('proveedores'));
 }
// obtener info de un proveedor
public function get_proveedor(Request $request){
    if($request->isMethod('post')){    

        if($datos = DB::Table('proveedores')->where('id', $request->id)->first()){
            return [
                'success' => 1,
                'proveedor' => $datos
            ];
        }else{
            return [
                'success' => 2 // proveedor no encontrado                   
            ];
        }
    }
}
   // agregar nuevo proveedor
   public function add_proveedor(Request $request){ 
    if($request->isMethod('post')){  
  
       $regla = array( 
           'nombre' => 'required',           
           'telefono' => 'required'
            );

       $mensaje = array(
           'nombre.required' => 'Nombre requerido',
           'telefono.required' => 'telefono requerido'
           );

       $validar = Validator::make($request->all(), $regla, $mensaje );

       if ($validar->fails())
       {
           return [
               'success' => 0, 
               'message' => $validar->errors()->all()
           ];
       }   

        $creaproveedor = proveedor::insertGetId([
            'nombre'=>$request->nombre,
            'telefono'=>$request->telefono,
            'nit'=>$request->nit,
            'nrc'=>$request->nrc,
            ]); 

       if($creaproveedor){               
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
    // editar proveedor
public function update_proveedor(Request $request){

    if($request->isMethod('post')){  

        // encontrar proveedor a modificar
        if($area = DB::table('proveedores')->where('id', $request->id)->first()){                        

            
                DB::table('proveedores')->where('id', '=', $request->id)->update(['nombre' => $request->nombre,
                'telefono' => $request->telefono,'nit' => $request->nit, 'nrc' => $request->nrc ]);
                
                return [
                    'success' => 1 // datos guardados correctamente
                ];                    
            }
        }else{
            return [
                'success' => 3 //Proveedor no encontrada
            ];
        }
    }
    // eliminar un proveedor
  public function delete_proveedor(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('proveedores')->where('id', $request->id)->first()){
            // borrar un proveedor
            DB::table('proveedores')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // proveedor eliminada       
            ];
        }else{
            return [
                'success' => 2 // proveedor no encontrado              
             ];
            }
        }
    }   
}
