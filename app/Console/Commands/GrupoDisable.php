<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class GrupoDisable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grupo:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Desativa todos os grupos que não postaram nos ultimos 30 dias';

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
    public function handle()
    {
        $grupos = \App\Grupo::where('status','ativado')->with('feeds')->get();
        foreach($grupos as $grupo){
            if($grupo->feeds->count() == 0){
                if(\Carbon::now()->gte($grupo->updated_at->addDays(40))){
                    $grupo->status = 'desativado';
                    $grupo->save();
                }
            }else{
                if(\Carbon::now()->gte($grupo->feeds->last()->updated_at->addDays(40))){
                    echo $grupo->id;
                    $grupo->status = 'desativado';
                    $grupo->save();
                }
            }
        }

    }
}
