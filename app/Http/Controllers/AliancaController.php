<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AliancaController extends Controller
{
    public function index(){
        $conquistas = \App\Conquista::find(1);
        $membros = $conquistas->grupo;
        return view('alianca',compact('membros'));
    }
}
