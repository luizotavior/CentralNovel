<?php

use Illuminate\Database\Seeder;
use App\Genero;
class GenerosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generos = array(
            "Ação",
            "Adulto",
            "Aventura",
            "Comédia",
            "Drama",
            "Ecchi",
            "Fantasia",
            "Gender Bender",
            "Harém",
            "Histórico",
            "Terror",
            "Josei",
            "Lolicon",
            "Artes Marciais",
            "Maduro",
            "Robô",
            "Mistério",
            "Psicológico",
            "Romance",
            "Vida Escolar",
            "Ficção Cientifica",
            "Seinen",
            "Shotacon",
            "Shoujo",
            "Shoujo Ai",
            "Shounen",
            "Shounen Ai",
            "Vida Cotidiana",
            "Smut",
            "Esportes",
            "Sobrenatural",
            "Tragédia",
            "Wuxia",
            "Xianxia",
            "Xuanhuan",
            "Yaoi",
            "Yuri"
        );

        foreach($generos as $genero){
            $genero = App\Genero::create([
                'nome'  => $genero
            ]);
        }

    }
}
