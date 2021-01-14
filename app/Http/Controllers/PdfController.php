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
use Carbon;
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
        $materiales = materiales::select('cuenta.codigo', 'cuenta.nombre', DB::raw('SUM(materiales_proyecto.cantidad*materiales.pu) as subtotal'))
            ->join('materiales_proyecto', 'materiales_proyecto.material_id', '=','materiales.id' )
            ->leftjoin('cuenta', 'cuenta.id', '=', 'materiales.cod')
            ->where('materiales_proyecto.proyecto_id', '=', '2')
            ->groupBy('materiales.cod')
            ->get();

      $pdf = PDF::loadView('backend.reportes.reforma_apertura', compact('proyecto','materiales'));
      $pdf->setPaper('letter', 'portrait')->setWarnings(false);
      return $pdf->stream('Resultado_Examen.pdf');
      //return view('backend.paginas.Hemo',compact('data'));
    
    }

}
