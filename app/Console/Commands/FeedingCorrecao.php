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
class FeedingCorrecao extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feeding:correcao';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Corrige as Novels não listadas';

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
        list($usec, $sec) = explode(' ', microtime());
        $script_start = (float) $sec + (float) $usec;

        $novels = \App\Novel::All();
        $novel_feeds = \App\Feed::where('capitulo','<>',null)->where('novel_id',null)->get();
        $novel_id = null;
        foreach($novel_feeds as $feed){
            $novel_id = null;
            foreach($novels as $novel){
                if(str_contains(str_slug($feed->titulo),str_slug($novel->titulo)) or str_contains($feed->url,str_slug($novel->titulo))){
                    $novel_id = $novel->id;
                    //echo "[".$feed->titulo."][".$novel->titulo."][".$novel->url."]\n";
                    break;
                }else{
                    if(!($novel->sigla == null or $novel->sigla == "")){
                        foreach(explode('-',str_slug($feed->titulo)) as $word){
                            if(str_is(str_slug($novel->sigla),str_slug($word))){
                                $novel_id = $novel->id;
                                //echo "[".$feed->titulo."][".$novel->sigla."]\n";
                            }
                        }
                    }
                }
            }
            if($novel_id != null){
                $feed->novel_id = $novel_id;
                $feed->save();
            }
        }

        list($usec, $sec) = explode(' ', microtime());
        $script_end = (float) $sec + (float) $usec;
        $elapsed_time = round($script_end - $script_start, 5);
        echo "\n \n \n -----  ".Carbon::now()->toDateTimeString()." ------ \n";
        echo 'Elapsed time: ', $elapsed_time, ' secs. Memory usage: ', round(((memory_get_peak_usage(true) / 1024) / 1024), 2), "Mb \n";
        echo ' ----- END ------';
    }
}
