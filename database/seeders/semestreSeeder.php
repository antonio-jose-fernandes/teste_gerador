<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class semestreSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       /* DB::table('semestres')->insert([
            'descricao'=>"2024.2",
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);*/
    }
}
