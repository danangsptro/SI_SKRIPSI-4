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
            'user_role' => 'pegawai',
            'username' => 'adminpegawai',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('qwerty'),
        ]);
    }
}
