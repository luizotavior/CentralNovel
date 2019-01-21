<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermosController extends Controller
{
    public function index(){
        return view('termos');
    }
}
