<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => \Hash::make(123456789),
            'phone_number' => 12345678910,
            'dob' => '2000-01-01',
            'created_at' => now(),
        ]);
    }
}
