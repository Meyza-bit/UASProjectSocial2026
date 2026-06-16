<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Memanggil seeder data dummy Mariberbagi
        $this->call([
            ProgramDonasiSeeder::class,
        ]);
    }
}