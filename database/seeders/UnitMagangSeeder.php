<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UnitMagangSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $units = [
            'Web Developer',
            'Pengolahan Citra',
            'Jaringan',
            'Android Developer',
            'Multimedia'
        ];

        for ($i = 1; $i <= count($units); $i++) {
            DB::table('unit_magang')->insert([
                'id_unitmagang' => 'UMG' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_unitmagang' => $units[$i-1],
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
