<?php

use Illuminate\Database\Seeder;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Tipo = App\Tipo::create(['nome' => 'Novel']);
        $Tipo = App\Tipo::create(['nome' => 'Web-Novel']);
        $Tipo = App\Tipo::create(['nome' => 'Light Novel']);
        $Tipo = App\Tipo::create(['nome' => 'Livro']);
    }
}
