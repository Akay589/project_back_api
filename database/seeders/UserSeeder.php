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
                'Login' => 'Fadmin',
                'mdp' => Hash::make( 'admin1234'),
                'nomU' => 'Franck Admin',
                'telU' => '0345697852',
                'mailU' => 'admin@masovia.com',
                'role_id' => '1',
                'adresseConstruction' => 'Tb 12 ivato',
            ]
        );
    }
}
