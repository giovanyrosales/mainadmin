<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\cotizacion;
use App\det_cotizacion;
use App\proveedor;
use App\admin_contrato;
use App\requisicion;
use App\deta_requisicion;
use App\proyecto;
use App\orden;
use Carbon\Carbon;
use PDF;

//Definir zona horaria o region.
date_default_timezone_set('America/El_Salvador');
setlocale(LC_ALL,"es_ES");

class OrdenController extends Controller
{
    // obtener info de una orden
    public function get_orden(Request $request){
        if($request->isMethod('post')){    

            if($datos = DB::Table('orden')->where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'orden' => $datos
                ];
            }else{
                return [
                    'success' => 2 // orden no encontrado                   
                ];
            }
        }
    }
    //pdf de orden de compra
    public function pdf_orden(Request $request)
    {
        $orden = DB::table('orden')->where('id',  $request->id)->first();
        $requisicion = DB::table('requisicion')->where('id',  $orden->requisicion_id)->get();
        $cotizacion = DB::table('cotizacion')->where('id',  $orden->cotizacion_id)->get();

        $pdf = PDF::loadView('backend.reportes.orden_compra', compact('orden', 'requisicion','cotizacion'));
        $pdf->setPaper('letter', 'portrait')->setWarnings(false);
        return $pdf->stream('Orden_Compra.pdf');
        //return view('backend.paginas.Hemo',compact('data'));
    }
    // agregar nueva Orden
    public function add_orden(Request $request){ 
        if($request->isMethod('post')){  
    
        $regla = array( 
            'requisicion_id' => 'required',
            'cotizacion_id' => 'required',           
            'proveedor_id' => 'required',
            'fechaorden' => 'required'
                );

        $mensaje = array(
            'requisicion_id.required' => 'Requisicion Requerida',
            'cotizacion_id.required' => 'Cotizacion requerida',
            'proveedor_id.required' => 'Proveedor requerido',
            'fechaorden.required' => 'Fecha requerida'
            );

        $validar = Validator::make($request->all(), $regla, $mensaje );

        if ($validar->fails())
        {
            return [
                'success' => 0, 
                'message' => $validar->errors()->all()
            ];
        }   

            $crearorden = orden::insertGetId([
                'admin_contrato_id'=>$request->admin_contrato_id,
                'fechaorden'=>$request->fechaorden,
                'lugar'=>$request->lugar,
                'cotizacion_id'=>$request->cotizacion_id,
                'requisicion_id'=>$request->requisicion_id,
                'proveedor_id'=>$request->proveedor_id]); 

        if($crearorden){  
            $orden_id = DB::getPdo()->lastInsertId();   
            return [
                'success' => 1,
                'orden_id'=> $orden_id
            ];
        }else{
            return [
                'success' => 2 //
            ];
         }

        }
    }
}
