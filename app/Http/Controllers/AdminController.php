<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }




    public function users(){
        return view('dashboard.admin.users');
    }
    
    public function teste(){
        $novel = \App\Novel::findOrFail(3);
    
        $this->authorize('novels.edit', [$novel]);
        
        echo "ok deu certo";
    }
}
