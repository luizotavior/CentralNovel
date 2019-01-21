<?php

use Illuminate\Database\Seeder;

class RecomendadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $recomendado = \App\Recomendado::create([
                'novel_id'  => 1
            ]);
         $recomendado = \App\Recomendado::create([
                'novel_id'  => 2
            ]);
    }
}
