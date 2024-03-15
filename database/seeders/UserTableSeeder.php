<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => "Sant Bohara",
            'email' => 'admin@example.com',
            'password' => Hash::make("12345678"),
            'email_verified_at' => now(),
        ]);
    }
}
