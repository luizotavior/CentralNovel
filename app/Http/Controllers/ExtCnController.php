<?php

namespace App\Http\Controllers;

use Request;
use Auth;
class ExtCnController extends Controller
{
    public function redirect($id){
        //
        try{
            //Localizando Feed
            $feed = \App\Feed::findOrFail($id);
            //Feed Clique
            $FClique = new \App\FClique;
            $FClique->ip = Request::ip();
            if(Auth::check()){
                $FClique->user_id = Auth::user()->id;
            }
            $FClique->feed_id = $feed->id;
            $FClique->save();
            //Novel CLique
            $NClique = new \App\NClique;
            $NClique->ip = Request::ip();
            if(Auth::check()){
                $NClique->user_id = Auth::user()->id;
            }
            $NClique->novel_id = $feed->novel_id;
            $NClique->save();

            return redirect()->away($feed->url."?utm=centralnovel");
        }catch (ModelNotFoundException $ex) {
        // Error handling code
        }
    }
}
