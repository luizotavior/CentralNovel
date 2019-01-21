<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Novel;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function favoritelBack($id){
        $novel = Novel::find($id);
        return redirect()->route('novel',['url'=> $novel->url]);
    }
    //Metodo Toggle, Usado para os Botões
    public function novelT(Request $request,$id){
        $this->createNovelFavoriteT($id);
        $novel = Novel::find($id);
        return redirect()->route('novel',['url'=> $novel->url]);
    }
    //Metodo Sync, Usado para os Parceiros
    public function novelS($id){
        $this->createNovelFavoriteS($id);
        $novel = Novel::find($id);
    }
    public function createNovelFavoriteT($id){
        $user = \App\User::find(Auth::User()->id);
        $user->favorito()->toggle($id);

    }
    public function createNovelFavoriteS($id){
        $user = \App\User::find(Auth::User()->id);
        $user->favorito()->sync($id);

    }
}
