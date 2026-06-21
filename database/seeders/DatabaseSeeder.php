<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User dummy
        User::factory(10)->create();

        // Jalankan seeder lain
        $this->call([
            FeedbackSeeder::class,
        ]);
    }
}