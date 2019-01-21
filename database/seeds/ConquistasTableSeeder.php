<?php

use Illuminate\Database\Seeder;

class ConquistasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Conquista = App\Conquista::create(['nome' => 'Aliança Novel','url' => str_slug('Aliança Novel')]);
        $Conquista = App\Conquista::create(['nome' => 'Parceiro CN','url' => str_slug('Parceiro CN')]);
    }
}
