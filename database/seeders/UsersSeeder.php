<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'SUPERADMIN',
            'password' => bcrypt('hellosuperadmin'),
            'role' => 'superAdmin',
            'email' => 'superadmin@gmail.com'
        ]);

        DB::table('users')->insert([
            'username' => 'ADMIN',
            'password' => bcrypt('helloadmin'),
            'role' => 'admin',
            'email' => 'admin@gmail.com'
        ]);

        DB::table('users')->insert([
            'username' => 'STUDENT',
            'password' => bcrypt('hellostudent'),
            'role' => 'student',
            'email' => 'student@gmail.com'
        ]);
    }
}
