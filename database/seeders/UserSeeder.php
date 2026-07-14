<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name'       => 'Budi Donatur',
                'email'      => 'budi@donasi.com',
                'password'   => Hash::make('1234'),
                'role'       => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Siti Rahma',
                'email'      => 'siti@donasi.com',
                'password'   => Hash::make('password'),
                'role'       => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Andi Saputra',
                'email'      => 'andi@donasi.com',
                'password'   => Hash::make('password'),
                'role'       => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}