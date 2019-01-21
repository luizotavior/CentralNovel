<?php

use Illuminate\Database\Seeder;

class LinguagensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Linguagem = App\Linguagem::create(['nome' => 'Português']);
        $Linguagem = App\Linguagem::create(['nome' => 'Inglês']);
        $Linguagem = App\Linguagem::create(['nome' => 'Japonês']);
        $Linguagem = App\Linguagem::create(['nome' => 'Coreano']);
        $Linguagem = App\Linguagem::create(['nome' => 'Chinês']);
    }
}
