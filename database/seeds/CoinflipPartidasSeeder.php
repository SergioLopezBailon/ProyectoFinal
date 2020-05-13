<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinflipPartidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coinflip_partidas')->insert([
            'idUser1' => 3,
            'status' => 'Espera',
            'quantity' => 1000,
            'user1Side'=>'Cara'
        ]);
        DB::table('coinflip_partidas')->insert([
            'idUser1' => 3,
            'status' => 'Espera',
            'quantity' => 1500,
            'user1Side'=>'Cara'
        ]);
        DB::table('coinflip_partidas')->insert([
            'idUser1' => 3,
            'status' => 'Espera',
            'quantity' => 400,
            'user1Side'=>'Cara'
        ]);
        DB::table('coinflip_partidas')->insert([
            'idUser1' => 3,
            'status' => 'Espera',
            'quantity' => 100,
            'user1Side'=>'Cara'
        ]);
        DB::table('coinflip_partidas')->insert([
            'idUser1' => 3,
            'status' => 'Espera',
            'quantity' => 250,
            'user1Side'=>'Cara'
        ]);
        DB::table('coinflip_partidas')->insert([
            'idUser1' => 3,
            'status' => 'Espera',
            'quantity' => 300,
            'user1Side'=>'Cara'
        ]);
        DB::table('coinflip_partidas')->insert([
            'idUser1' => 3,
            'status' => 'Espera',
            'quantity' => 350,
            'user1Side'=>'Cara'
        ]);
    }
}
