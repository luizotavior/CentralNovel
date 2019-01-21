<?php

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Cateogria = App\Categoria::create(['nome' => 'Capítulo']);
        $Cateogria = App\Categoria::create(['nome' => 'Noticia']);
    }
}
