<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {
        $idusuario =  auth()->user()->id;
        $usuario =  DB::table('users')->where('id', $idusuario)->first();
        return view('backend.index',compact('usuario'));
    }

    public function getInicio(){
                

        return view('backend.paginas.inicio');
    }
}
