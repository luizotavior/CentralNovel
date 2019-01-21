<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TesteFist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teste:first';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando de Teste Numero 01';

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
    }
}
