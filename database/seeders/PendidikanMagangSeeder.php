<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Magang;
use App\Models\Pend_Magang;
use Faker\Factory as Faker;

class PendidikanMagangSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kategoriWajib = [
            'sd_mi' => [1, 2],        // SD atau MI, ambil 1 random
            'smp_mts' => [3, 4],      // SMP atau MTS, ambil 1 random
            'sma_ma_smk' => [5, 6, 7] // SMA/MA/SMK, ambil 1 random
        ];

        $jenjangOpsional = [8, 9, 10, 11, 12, 13]; // S1, S2, S3, D1, D3, D4

        $magangList = Magang::all();

        foreach ($magangList as $magang) {

            // Masukkan jenjang wajib: satu random dari tiap kategori
            foreach ($kategoriWajib as $kategori) {
                $id_jjg = $faker->randomElement($kategori);

                Pend_Magang::create([
                    'no_magang' => $magang->no_magang,
                    'id_jjg' => $id_jjg,
                    'nama_pend' => $faker->company . ' School',
                    'thn_pend' => $faker->numberBetween(1990, 2015),
                ]);
            }

            // Masukkan jenjang opsional (0 hingga semua)
            $jumlahOpsional = rand(0, count($jenjangOpsional));
            $opsionalTerpilih = $faker->randomElements($jenjangOpsional, $jumlahOpsional);

            foreach ($opsionalTerpilih as $id_jjg) {
                Pend_Magang::create([
                    'no_magang' => $magang->no_magang,
                    'id_jjg' => $id_jjg,
                    'nama_pend' => $faker->company . ' University',
                    'thn_pend' => $faker->numberBetween(2010, 2023),
                ]);
            }
        }
    }
}
