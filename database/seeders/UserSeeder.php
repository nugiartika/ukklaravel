<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'role' =>  'Admin',
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => 'member',
            'email' => 'member@gmail.com',
            'password' => 'password',
            'role' =>  'Member',
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => 'pimpinan ',
            'email' => 'pimpinan@gmail.com',
            'password' => 'password',
            'role' =>  'Pimpinan',
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'password' => 'password',
            'role' =>  'Kasir',
            'email_verified_at' => now(),
        ]);
    }
}
