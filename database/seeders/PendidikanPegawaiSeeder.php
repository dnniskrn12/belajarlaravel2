<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\Pend_Pegawai;
use Faker\Factory as Faker;

class PendidikanPegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua pegawai
        $pegawaiList = Pegawai::all();

        foreach ($pegawaiList as $pegawai) {
            // Tentukan jumlah pendidikan tiap pegawai (1-3)
            $jumlahPendidikan = rand(1, 6);

            for ($i = 0; $i < $jumlahPendidikan; $i++) {
                Pend_Pegawai::create([
                    'id_pegawai' => $pegawai->id,
                    'id_jjg' => rand(1, 6), // Sesuaikan dengan id_jenjang yang ada
                    'nama_pend' => $faker->company . ' School', // Bisa diganti sesuai kebutuhan
                    'thn_pend' => $faker->numberBetween(2000, 2023),
                ]);
            }
        }
    }
}
