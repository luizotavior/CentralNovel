<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nome' => "Luiz Otávio Rodrigues",
            'username' => "Keyel",
            'email' => 'luiz.otavior18@gmail.com',
            'password' => bcrypt('sugoi123'),
        ]);
    }
}
