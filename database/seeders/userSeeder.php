<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>"pitdiren",
            'password'=>bcrypt("-Diren2024"),
            'email'=>"diren@gmail.com",
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Coordenadoria de Tecnologia da Informação',
            'password' => Hash::make('qwe123'),
            'email' => 'ti.sobral@ifce.edu.br',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        DB::table('users')->insert([
            'name' => 'teste',
            'password' => Hash::make('123'),
            'email' => 'teste@ifce.edu.br',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
