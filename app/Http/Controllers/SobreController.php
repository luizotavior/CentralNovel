<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreController extends Controller
{
    
    public function index()
    {
        $populares = \App\Novel::withCount('clique')
            ->with('genero')
            ->with('avgRating')
            ->orderBy('clique_count','DESC')
            ->take(5)
            ->get();
        return view('sobre',compact('populares'));
    }
}
