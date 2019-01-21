<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            CategoriasTableSeeder::class,
            ConquistasTableSeeder::class,
            TiposTableSeeder::class,
            //
            GenerosTableSeeder::class,
            GruposTableSeeder::class,
            LinguagensTableSeeder::class,
            NovelsTableSeeder::class,
            RecomendadosTableSeeder::class,
            UsersTableSeeder::class,
            PermissionsTableSeeder::class,
        ]);
    }
}
