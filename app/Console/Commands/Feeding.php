<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Grupo;
use App\Feed;
use App\Novel;
use Carbon\Carbon;
use Feeds;
use Helper;
class Feeding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feeding:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza a Lista de Feed do Sistema';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    function whole_numeric($val){
        if (preg_match ("/^([0-9]+)$/", $val)) {
            return true;
        } else {
            return false;
        }
    }
    public function handle()
    {
        $this->info('----- START ------');
        list($usec, $sec) = explode(' ', microtime());
        $script_start = (float) $sec + (float) $usec;
        $grupos = \App\Grupo::where('status','ativado')->get();
        $novels = \App\Novel::where('status','ativado')->get();
        $this->line('Grupos :'.$grupos->count());
        $this->line('Novels :'.$novels->count());
        foreach($grupos as $grupo){
            $feed = Feeds::make($grupo->feed);
            $feed->enable_cache(false);
            $data = array(
                'title'     => $feed->get_title(),
                'permalink' => $feed->get_permalink(),
                'items'     => $feed->get_items(),
            );
            foreach($data['items'] as $item){
                $ok = true;
                $feeds_lancados = \App\Feed::Where('published_at',$item->get_date('Y-m-d H:i:s'))->get();
                foreach($feeds_lancados as $verificacao){
                    if($feed->titulo = $item->get_title() == $verificacao->titulo){
                        $ok = false;
                    }
                }
                if($ok){

                    $novel_id = null;
                    $sigla = 0;
                    $arco = null ;
                    $volume = null ;
                    $capitulo = null ;
                    $parte = null ;
                    $pos_atual = 0;

                    $feed_titulo = str_replace(['/','-','[',']'],' ',$item->get_title());
                    //echo str_slug($feed_titulo,'-');
                    $feed_titulo = explode('-',str_slug($feed_titulo,'-'));
                    
                    foreach($novels as $novel){
                        if(str_contains(str_slug($item->get_title()),str_slug($novel->titulo)) or str_contains($item->get_permalink(),str_slug($novel->titulo))){
                            $novel_id = $novel->id;
                            break;
                        }else{
                            if(!($novel->sigla == null or $novel->sigla == "")){
                                foreach($feed_titulo as $word){
                                    if(str_is(str_slug($novel->sigla),str_slug($word))){
                                        $novel_id = $novel->id;
                                        //echo "[".$feed->titulo."][".$novel->sigla."]\n";
                                    }
                                }
                            }
                        }
                    }
                    //echo "\n";
                    //echo $item->get_permalink();
                    //echo "\n";
                    foreach($feed_titulo as $word){
                        if(isset($feed_titulo[$pos_atual+1])){
                            if(str_is(['arco'],str_slug($word))){
                                if(isset($feed_titulo[$pos_atual+1]) and  is_numeric($feed_titulo[$pos_atual+1])){
                                    $arco = $feed_titulo[$pos_atual+1];
                                }
                            }
                            if(str_is(['volume','vol','v'],str_slug($word))){
                                if(isset($feed_titulo[$pos_atual+1]) and  is_numeric($feed_titulo[$pos_atual+1])){
                                    $volume =  (INT) $feed_titulo[$pos_atual+1];
                                }
                            }
                            if(str_is(['capitulo','cap','c'],str_slug($word))){
                                if(isset($feed_titulo[$pos_atual+1]) and is_numeric($feed_titulo[$pos_atual+1])){
                                    $capitulo =  (INT) $feed_titulo[$pos_atual+1];
                                    $x=2;
                                    for($x = 2;($pos_atual+$x)<count($feed_titulo);$x++){
                                        if(is_numeric($feed_titulo[$pos_atual+$x])){
                                            $capitulo .= ";".( (INT) $feed_titulo[$pos_atual+$x]);
                                        }elseif(!(str_is(['a','ate','e'],str_slug($feed_titulo[$pos_atual+$x])))){
                                            break;
                                        }
                                    }
                                }
                            }
                            if(str_is(['parte','pt','p'],str_slug($word))){
                                if(isset($feed_titulo[$pos_atual+1]) and is_numeric($feed_titulo[$pos_atual+1])){
                                    $parte =  (INT) $feed_titulo[$pos_atual+1];
                                    $x=2;
                                    for($x = 2;($pos_atual+$x)<count($feed_titulo);$x++){
                                        if(is_numeric($feed_titulo[$pos_atual+$x])){
                                            $parte .= ";".( (INT) $feed_titulo[$pos_atual+$x]);
                                        }elseif(!(str_is(['a','ate','e'],str_slug($feed_titulo[$pos_atual+$x])))){
                                            break;
                                        }
                                    }
                                }
                            }
                            if(str_is('v*c*',str_slug($word))){
                                $letras = str_replace(['v','c'],'v',str_slug($word));
                                $letras = explode('v',$letras);
                                if(is_numeric($letras[1]) and $volume == null){
                                    $volume =  (INT) $letras[1];
                                }
                                if(is_numeric($letras[2]) and $capitulo == null){
                                    $capitulo =  (INT) $letras[2];
                                }
                            }
                        }else{
                            if(str_contains(str_slug($item->get_title()),['prólogo','prologo']) and $capitulo == null){
                                $capitulo = "Prólogo";
                            }
                            if(str_contains(str_slug($item->get_title()),['epílogo','epilogo']) and $capitulo == null){
                                $capitulo = "Epílogo";
                            }


                            if($capitulo == null){
                                $pos_atual = 0;
                                foreach($feed_titulo as $word){
                                    if(is_numeric($word) and isset($feed_titulo[$pos_atual-1]) and !str_is(['arco','volume','vol','v','capitulo','cap','c','parte','pt','p','a','ate','e'],str_slug($feed_titulo[$pos_atual-1]))){
                                        $capitulo =  (INT) $feed_titulo[$pos_atual];
                                        break;
                                    }
                                    $pos_atual++;
                                }
                            }
                        }
                        $pos_atual++;
                    }	
                    $feed = new \App\Feed;
                    $feed->titulo = $item->get_title();
                    $feed->url = $item->get_permalink();
                    $feed->descricao = $item->get_description();
                    $feed->published_at = $item->get_date('Y-m-d H:i:s');
                    $feed->grupo_id = $grupo->id;
                    $feed->novel_id = $novel_id;
                    $feed->categoria_id = $grupo->categoria_id;
                    if(isset($arco)){
                        $feed->arco = $arco;
                    }
                    if(isset($volume)){
                        $feed->volume = $volume;
                    }
                    if(isset($capitulo)){
                        $feed->capitulo = $capitulo;
                    }
                    if(isset($parte)){
                        $feed->parte = $parte;
                    }
                    $feed->save();
                }
            }
        }
        list($usec, $sec) = explode(' ', microtime());
        $script_end = (float) $sec + (float) $usec;
        $elapsed_time = round($script_end - $script_start, 5);
        //
        $tag = new \App\Tag;
        $mytime = Carbon::now();
        $tag->nome = 'Date: '.$mytime->toDateTimeString().'. Elapsed time: '.$elapsed_time.' secs. Memory usage: '.round(((memory_get_peak_usage(true) / 1024) / 1024), 2)."Mb";
        $tag->save();

        $this->line('Date: '.Carbon::now()->format('d/m/Y H:i:s').'. Elapsed time: '.$elapsed_time.' secs. Memory usage: '.round(((memory_get_peak_usage(true) / 1024) / 1024), 2).'Mb');
        $this->info('----- END ------');
    }
}
