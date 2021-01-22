<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\proyecto;
use App\materiales_proyecto;
use App\materiales;
use App\cuentaproy;
use App\movibolson;
use Carbon\Carbon;
use PDF;

//Definir zona horaria o region.
date_default_timezone_set('America/El_Salvador');
setlocale(LC_ALL,"es_ES");

class PdfController extends Controller
{
    //pdf_reforma_apertura
    public function pdf_reforma_apertura(Request $request)
    {
        $proyecto = DB::table('proyecto')->where('id',  $request->id)->first();
        $materiales = materiales::select('cuenta.codigo', 'cuenta.id as cuentaid', 'cuenta.nombre', DB::raw('SUM(materiales_proyecto.cantidad*materiales.pu) as subtotal'))
            ->join('materiales_proyecto', 'materiales_proyecto.material_id', '=','materiales.id' )
            ->leftjoin('cuenta', 'cuenta.id', '=', 'materiales.cod')
            ->where('materiales_proyecto.proyecto_id', '=', $proyecto->id)
            ->groupBy('materiales.cod')
            ->get();
        $total = 0.0;
        // borrar cuentas
        DB::table('cuentaproy')->where('proyecto_id', $proyecto->id)->delete();
        foreach($materiales as $val){
            $total = $total + floatval($val->subtotal);
            // volver a crear las cuentas por proyecto
            $cuentaproy = cuentaproy::insertGetId([
                'proyecto_id'=>$proyecto->id,
                'cuenta_id'=>$val->cuentaid,
                'montoini'=>$proyecto->monto,
                'saldo'=>$proyecto->monto]); 
        }
        $bolson = DB::table('bolson')->where('id',  $proyecto->bolson_id)->first();

        $areagestionn = DB::table('areagestion')->where('id',  $proyecto->areagestion)->first();
        $linean= DB::table('linea')->where('id',  $proyecto->linea)->first();
        $fuentefn = DB::table('fuentef')->where('id',  $proyecto->fuentef)->first();
        $fuentern = DB::table('fuenter')->where('id',  $proyecto->fuenter)->first();

        $cuenta = DB::table('cuenta')->where('id',  $bolson->cuenta_id)->first();

        $fecha_actual = Carbon::now();
        $date = $fecha_actual->format('Y-m-d');
        //(verificar antes si ya existe el movimiento de creacion en la cuenta bolson)
        $vermovibolson = DB::table('movibolson')->where('proyecto_id',  $proyecto->id)->where('tipomovi_id','1')->first();
        if(!$vermovibolson){
        // Guardar movimiento en la cuenta bolson. 
        $cuentabolson = movibolson::insertGetId([
            'bolson_id'=>$proyecto->bolson_id,
            'disminuye'=>$proyecto->monto,
            'fecha'=>$date,
            'tipomovi_id'=>'1',
            'proyecto_id'=>$proyecto->id]); 
        }
        if(!$vermovibolson && $cuentabolson){
            // Actualizar saldo de cuenta bolson.
            $nuevosaldo = floatval($bolson->saldo) - floatval($proyecto->monto);
            DB::table('bolson')->where('id', '=', $bolson->id)->update(['saldo' => $nuevosaldo ]);
        }
      $pdf = PDF::loadView('backend.reportes.reforma_apertura', compact('proyecto','materiales', 'cuenta', 'total', 'linean', 'fuentern', 'fuentefn', 'areagestionn'));
      $pdf->setPaper('letter', 'portrait')->setWarnings(false);
      return $pdf->stream('Resultado_Examen.pdf');
      //return view('backend.paginas.Hemo',compact('data'));
    
    }

}
