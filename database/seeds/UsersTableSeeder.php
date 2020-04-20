<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'balance' => 100000,
            'rol'=>'admin',
            'payment'=>'PayPal'
        ]);
        
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'sergio@gmail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            'payment'=>'PayPal'
        ]);
    }
}
