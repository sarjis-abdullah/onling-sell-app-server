<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'name' => 'Admin',
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'role_id' => 2,
            'email' => 'user@gmail.com',
            'password' => Hash::make('user@gmail.com'),
        ]);
    }
}
