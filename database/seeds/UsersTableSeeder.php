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
            'position' => 'pegawai',
            'username' => 'adminpegawai',
            'email' => 'admin@gmail.com',
            'company' => 'testing',
            'contact' => '08128128128',
            'status' => 'Non-Active',
            'password' => Hash::make('qwerty'),
        ]);
    }
}
