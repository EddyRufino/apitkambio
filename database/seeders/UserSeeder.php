<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startYear    = '1980';
        $lastYear     = '2010';
        $startNumber  = '01'; // Inicio de día o mes
        $lastDay      = '31';
        $lastMonth    = '12';

        for ($i = 0; $i <= 100; $i++)  {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'birth_date' => Carbon::create(
                        mt_rand($startYear, $lastYear),    // Año
                        mt_rand($startNumber, $lastMonth),  // Mes
                        mt_rand($startNumber, $lastDay)     // Día
                    ),
                'password' => Hash::make('tkambio'),
                'created_at' => Carbon::now()
            ]);
        }
    }
}
