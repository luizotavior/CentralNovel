<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ImageRepository;

class DashboardController extends Controller
{
    
    //
    public function index(){
        return view('dashboard.home');
    }
    public function novels(){
        return view('dashboard.novels');
    }



    public function novelAltStore(){
    }
    public function novelDelStore(){
    }
}
