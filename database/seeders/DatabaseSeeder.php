<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@donasi.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // User dummy
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            'role'  => 'user',
        ]);

        // Jalankan seeder lain
        $this->call([
            FeedbackSeeder::class,
        ]);
    }
}