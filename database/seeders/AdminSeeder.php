<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'greenmousetest@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'user_type' => 'Administrator',
            'phone_number' => 1234567890
        ]);
    }
}
