<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user test
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Jalankan seeder pegawai
        $this->call([
            PegawaiSeeder::class,
            PendidikanPegawaiSeeder::class, // Seeder pendidikan tiap pegawai
        ]);
    }
}
