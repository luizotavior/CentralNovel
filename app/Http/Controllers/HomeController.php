<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Feeds;
use App\Feed;
use Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    
    public function index()
    {
        $feed = new Feed;
        $relationships = $feed->relationships;
        $feeds = $feed::where('novel_id','!=','null')->where('categoria_id','1')->with($relationships)->orderBy('published_at', 'DESC')->paginate(30);
        $votadas = \App\Novel::withCount('nota')
            ->with('genero')
            ->with('nota')
            ->with('avgRating')
            ->get()
            ->map(function ($item, $key) {
                $item->rating = $item->nota()->whereMonth('created_at', '=', date('m'))->avg('nota');
                return $item;
            })
            ->where('rating','>=',0)
            ->where('nota_count','>=',0)
            ->sortByDesc('nota_count')
            ->take('36')
            ->sortByDesc('rating')
            ->take('6');
        $populares = \App\Novel::withCount('clique')
            ->with('genero')
            ->with('avgRating')
            ->orderBy('clique_count','DESC')
            ->take(5)
            ->get();
        $noticia = \App\Feed::where('categoria_id','2')
            ->with('grupo')
            ->orderBy('published_at','Desc')
            ->first();
        $recomendados = \App\Novel::with('genero')->find(\App\Recomendado::find([1,2])->pluck('novel_id')->toArray());
        $generos = \App\Genero::find(['2','5','6','7','10','15','17','19']);
        return view('home',compact('populares','noticia','recomendados','votadas','generos','feeds'));
    }
}
