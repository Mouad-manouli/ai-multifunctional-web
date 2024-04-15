<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use app\model\admin;
use app\models\utilisateur;

class utilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('utilisateur')->insert([
            'name'=>'mouad',
            'email'=>'mouad@gmail.com',
            'password'=>'mouad2003'
        ]);
    }
}
