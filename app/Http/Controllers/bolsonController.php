<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\bolson;
use App\cuenta;

class bolsonController extends Controller
{
   // retornar vista 
  public function load_bolsones(){
    //para cargar las cuentas bolson
     $bolsones = bolson::all();
     $cuentas = cuenta::all();
     return view('backend.paginas.Bolsones',compact('bolsones','cuentas'));
 }

     // obtener informacion una cuenta para actualizarla
     public function infoBolson(Request $request){
        if($request->isMethod('post')){    

            if($datos = DB::Table('bolson')->where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'bolson' => $datos
                ];
            }else{
                return [
                    'success' => 2 // cuenta no encontrado                   
                ];
            }
        }
    }

   // agregar nueva cuenta bolson
   public function nuevobolson(Request $request){ 
    if($request->isMethod('post')){  
  
       $regla = array( 
           'nombre' => 'required',           
           'fecha' => 'required',
           'cuenta_id' => 'required',
           'montoini' => 'required'
            );

       $mensaje = array(
           'nombre.required' => 'Nombre de la cuenta requerio',
           'fecha.required' => 'fecha requerida',
           'cuenta_id.required' => 'cuenta requerida',
           'montoini' => 'Monto inicial requerido'
           );

       $validar = Validator::make($request->all(), $regla, $mensaje );

       if ($validar->fails())
       {
           return [
               'success' => 0, 
               'message' => $validar->errors()->all()
           ];
       }   

        $crearcuenta = bolson::insertGetId([
       'nombre'=>$request->nombre,
       'fecha'=>$request->fecha,
       'cuenta_id'=>$request->cuenta_id,
       'saldo'=>$request->montoini,
       'montoini'=>$request->montoini]); 

       if($crearcuenta){               
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

// editar cuenta bolson
public function update_bolson(Request $request){

    if($request->isMethod('post')){  

        // encontrar servicio a modificar
        if($bolson = DB::table('bolson')->where('id', $request->id)->first()){                        

            
                DB::table('bolson')->where('id', '=', $request->id)->update(['nombre' => $request->nombre,
                'fecha' => $request->fecha,
                'montoini' => $request->montoini,
                'cuenta_id' => $request->cuenta_id]);
                
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
  public function deleteBolson(Request $request){
    if($request->isMethod('post')){  

        if($datos = DB::table('bolson')->where('id', $request->id)->first()){
            // borrar cuenta
            DB::table('bolson')->where('id', $request->id)->delete();
            
            return [
                'success' => 1 // cuenta eliminada           
            ];
        }else{
            return [
                'success' => 2 // cuenta no encontrada                
            ];
        }
    }
}

}
