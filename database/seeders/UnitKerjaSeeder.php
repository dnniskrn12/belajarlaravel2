<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UnitKerjaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $units = [
            'Pengelolaan Data dan Statistik',
            'Pengelolaan Komunikasi Publik',
            'Pengembangan Aplikasi Informatika',
            'Persandian, POS, dan Telekomunikasi',
            'Sumber Daya Komunikasi Publik',
            'Infrastruktur Teknologi Informasi dan Komunikasi',
            'Layanan Informasi dan Kebijakan',
            'Teknologi Informasi dan Komunikasi',
            'Kemitraan Komunikasi Publik',
            'Tata Kelola dan Pemberdayaan TIK'
        ];

        for ($i = 1; $i <= count($units); $i++) {
            DB::table('unit_kerja')->insert([
                'id_unitkerja' => 'UKJ' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_unitkerja' => $units[$i-1],
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
