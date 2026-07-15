<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Akun Admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@donasi.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Akun User Biasa
        User::create([
            'name'     => 'User',
            'email'    => 'ocel@gmail.com',
            'password' => Hash::make('1234'),
            'role'     => 'user',
        ]);

        // Jalankan seeder lain
        $this->call([
        TargetPenerimaSeeder::class,
        ProgramDonasiSeeder::class,
        UserSeeder::class,
        DonasiDanaSeeder::class,
        DonasiApiSeeder::class,
        BarangSeeder::class,
        FeedbackSeeder::class,
        ]);
    }
}