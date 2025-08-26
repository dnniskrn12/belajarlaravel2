<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 15; $i++) {
            $status = $faker->randomElement(['Aktif', 'Non Aktif']);

            Pegawai::create([
                'no_pegawai' => 'PEG' . $faker->unique()->numberBetween(100, 999),
                'nama_pegawai' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '-40 years'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'alamat' => $faker->address,
                'agama' => $faker->randomElement(['Islam', 'Kristen Protestan', 'Katholik', 'Hindu', 'Budha', 'Konghucu']),
                'no_hp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'status_kwn' => $faker->randomElement(['Menikah', 'Belum Menikah']),
                'status_pekerjaan' => $status,
                'tgl_masuk' => $faker->date('Y-m-d', 'now'),
                'tgl_akhir' => $status === 'Non Aktif'
                    ? $faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d')
                    : null,
                'foto' => 'default.png',
            ]);
        }
    }
}
