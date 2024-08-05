<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(

            [

                'Login' => 'sadmin',
                'mdp' => Hash::make('admin1234'),
                'nomU' => 'Spendo Admin',
                'telU' => '0345842071',
                'mailU' => 'admin@masovia-madagascar.com',
                'AdresseConstruction' => 'VP 14 ivandry'
            ]
        );
        DB::table('users')->insert(

            [

                'Login' => 'fraz',
                'mdp' => Hash::make('francois0107'),
                'nomU' => 'Francois Raz',
                'telU' => '034659785',
                'mailU' => 'francois@masovia-madagascar.com',
                'AdresseConstruction' => 'VP 12 ivanja'
            ]
        );
    }
}
