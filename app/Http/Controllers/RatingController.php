<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use App\NNota;
use App\Novel;
use App\GNota;
use App\Grupo;

class RatingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    protected function validator(array $data){
        return Validator::make($data, [
        'rating' => 'required|integer|min:1|max:5',
        ]);
    }

    public function novelBack($id){
        $novel = Novel::find($id);
        return redirect()->route('novel',['url'=> $novel->url]);
    }
    public function grupoBack($id){
        $grupo = Grupo::find($id);
        return redirect()->route('grupo',['url'=> $grupo->url]);
    }
    
    public function novel(Request $request,$id){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $errors = $validator->errors();
            //dd($request->all(),$errors);
            return back()->withErrors($validator)->withInput();
        }
        //dd($request->all());
        $this->createNRating($request,$id);

        return back();
    }

    public function createNRating(Request $request,$id){
        $NNota = \App\NNota::updateOrCreate(
            ['user_id' => Auth::user()->id,'novel_id' => $id], ['nota' => $request->input('rating')]
        );

    }

    
    public function grupo(Request $request,$id){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $errors = $validator->errors();
            //dd($request->all(),$errors);
            return back()->withErrors($validator)->withInput();
        }
        //dd($request->all());
        $this->createGRating($request,$id);

        return back();
    }

    public function createGRating(Request $request,$id){
        $GNota = \App\GNota::updateOrCreate(
            ['user_id' => Auth::user()->id,'grupo_id' => $id], ['nota' => $request->input('rating')]
        );

    }
}
