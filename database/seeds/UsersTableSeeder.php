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
        ]);
        
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'sergio@gmail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
        ]);
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'sergio@gm1ail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'sergio@gma2il.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
      
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'sergio@g3ma1il.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'serg1io@g3mail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'ser1gio@g3mail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'sergi2o@g3mail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'ser1gi1o@g3mail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'se12rgio@g3mail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'sergio@g123mail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'ser1232gio@g3mail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
        DB::table('users')->insert([
            'name' => 'sergio',
            'email' => 'ser12311agio@g3mail.com',
            'password' => Hash::make('sergio'),
            'balance' => 0,
            'rol'=>'user',
            
        ]);
    }
}
