<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use App\User;
use DataTables;
use Carbon\Carbon;
class DataTablesController extends Controller
{
    //
    public function feed(){
        $feed = new Feed;
        $relationships = $feed->relationships;
        $feed = $feed::where('novel_id','!=','null')->where('categoria_id','1')->with($relationships)->orderBy('published_at', 'DESC')->get();
        $feed = $feed->map(function($feed){
            if(Carbon::today() >= $feed->published_at_diff){
                $feed->published_at_diff = $feed->published_at->diffForHumans();
            }else{
                $feed->published_at_diff = $feed->published_at;
            }
            return $feed;
        });
        return Datatables::of($feed)->make(true);
        //return datatables()->of(Feed::orderBy('published_at', 'DESC')->get())->toJson();
    }
    public function user()
    {
        $users = User::All();
        return Datatables::of($users)->make(true);
    }

    public function novel($id)
    {
        $feed = new Feed;
        $relationships = $feed->relationships;
        $feed = $feed::where('novel_id','!=','null')->where('novel_id',$id)->where('categoria_id','1')->with($relationships)->orderBy('published_at', 'DESC')->get();
        $feed = $feed->map(function($feed){
            if(Carbon::today() >= $feed->published_at_diff){
                $feed->published_at_diff = $feed->published_at->diffForHumans();
            }else{
                $feed->published_at_diff = $feed->published_at;
            }
            return $feed;
        });
        return Datatables::of($feed)->make(true);
        //return datatables()->of(Feed::orderBy('published_at', 'DESC')->get())->toJson();
    }
    public function grupo($id)
    {
        $feed = new Feed;
        $relationships = $feed->relationships;
        $feed = $feed::where('novel_id','!=','null')->where('grupo_id',$id)->with($relationships)->orderBy('published_at', 'DESC')->get();
        $feed = $feed->map(function($feed){
            if(Carbon::today() >= $feed->published_at_diff){
                $feed->published_at_diff = $feed->published_at->diffForHumans();
            }else{
                $feed->published_at_diff = $feed->published_at;
            }
            return $feed;
        });
        return Datatables::of($feed)->make(true);
        //return datatables()->of(Feed::orderBy('published_at', 'DESC')->get())->toJson();
    }

    public function feedApi()
    {
        $feed = new Feed;
        $relationships = $feed->relationships;
        $feed = $feed::where('novel_id','!=','null')
            ->where('categoria_id','1')
            ->with($relationships)
            ->orderBy('published_at', 'DESC')
            ->paginate(20);
        //Resultado em Json
        return \Response::json($feed,200);
    }
}
