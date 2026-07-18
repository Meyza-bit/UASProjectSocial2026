<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Pindahkan data ke dalam array terlebih dahulu
        $users = [
            [
                'name'     => 'Admin',
                'email'    => 'admin@donasi.com',
                'password' => Hash::make('admin123'), // Silakan ganti password admin di sini
                'role'     => 'admin',
            ],
            [
                'name'     => 'Budi Donatur',
                'email'    => 'budi@donasi.com',
                'password' => Hash::make('1234'),
                'role'     => 'user',
            ],
            [
                'name'     => 'Siti Rahma',
                'email'    => 'siti@donasi.com',
                'password' => Hash::make('password'),
                'role'     => 'user',
            ],
            [
                'name'     => 'Andi Saputra',
                'email'    => 'andi@donasi.com',
                'password' => Hash::make('password'),
                'role'     => 'user',
            ],
        ];

        // Loping data untuk disimpan dengan aman
        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']], // Kunci pengecekan berdasarkan email unik
                [
                    'name'     => $userData['name'],
                    'password' => $userData['password'],
                    'role'     => $userData['role'],
                ]
            );
        }
    }
}