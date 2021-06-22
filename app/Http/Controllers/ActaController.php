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
use App\acta;
use Carbon\Carbon;
use PDF;

//Definir zona horaria o region.
date_default_timezone_set('America/El_Salvador');
setlocale(LC_ALL,"es_ES");

//Estados de las Ordenes
// 1 - Activa
// 2 - Anulada
// 0 - Default
//Estados de las Cotizaciones
// 0 - Default
// 1 - Aprobada
// 2 - Denegada
class ActaController extends Controller
{
    // obtener info de una acta
    public function get_acta(Request $request){
        if($request->isMethod('post')){    

            if($datos = DB::Table('acta')->where('id', $request->id)->first()){
                return [
                    'success' => 1,
                    'acta' => $datos
                ];
            }else{
                return [
                    'success' => 2 // acta no encontrada                 
                ];
            }
        }
    }

    
    // agregar nueva acta
    public function add_acta(Request $request){ 
        if($request->isMethod('post')){  
    
        $regla = array( 
            'fechaacta' => 'required',
            'orden_id' => 'required'
            );

        $mensaje = array(
            'fechaacta.required' => 'Fecha Acta Requerida',
            'orden_id.required' => 'Orden asociada requerida'
            );

        $validar = Validator::make($request->all(), $regla, $mensaje );

        if ($validar->fails())
        {
            return [
                'success' => 0, 
                'message' => $validar->errors()->all()
            ];
        }   
        $crearacta = acta::insertGetId([
            'fechaacta'=>$request->fechaacta,
            'orden_id'=>$request->orden_id,
            'hora'=> $request->horaacta,
            'estado'=>'1']); 

        if($crearacta){  
            $acta_id = DB::getPdo()->lastInsertId();   
            return [
                'success' => 1,
                'acta_id'=> $acta_id
            ];
        }else{
            return [
                'success' => 2 //
            ];
         }

        }
    }

    public function pdf_acta(Request $request)
    {
        $acta = DB::table('acta')->where('id',  $request->id)->first();
        $orden = DB::table('orden')->where('id',  $acta->orden_id)->first();
        $proveedor =  DB::table('proveedores')->where('id',  $orden->proveedor_id)->first();
        $administrador = DB::table('admin_contrato')->where('id',  $orden->admin_contrato_id)->first();
        $requisicion = DB::table('requisicion')->where('id',  $orden->requisicion_id)->first();
        $proyecto =  DB::table('proyecto')->where('id',  $requisicion->proyecto_id)->first();
        
        $fecha = strftime("%d-%B-%Y",strtotime($acta->fechaacta));
        $hora = $acta->hora;

        
        $pdf = PDF::loadView('backend.reportes.acta_orden_compra', compact('acta','proyecto','fecha','proveedor','administrador','hora','orden'));

        $pdf->setPaper('letter', 'portrait')->setWarnings(false);
        return $pdf->stream('acta_orden_compra.pdf');
        //return view('backend.reportes.acta_orden_compra', compact('acta','proyecto','fecha','proveedor','administrador','hora'));
    }
}
