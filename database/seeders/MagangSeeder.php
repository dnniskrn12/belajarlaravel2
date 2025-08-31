<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Magang;
use Faker\Factory as Faker;

class MagangSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 15; $i++) {
            $status = $faker->randomElement(['Aktif', 'Non Aktif']);

            Magang::create([
                'no_magang' => 'MAG' . $faker->unique()->numberBetween(100, 999),
                'nama_siswa' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '-40 years'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'alamat' => $faker->address,
                'agama' => $faker->randomElement(['Islam', 'Kristen Protestan', 'Katholik', 'Hindu', 'Budha', 'Konghucu']),
                'no_hp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'status_magang' => $status,
                'tgl_masuk' => $faker->date('Y-m-d', 'now'),
                'tgl_akhir' => $status === 'Non Aktif'
                    ? $faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d')
                    : null,
                'foto' => 'default.png',
            ]);
        }
    }
}
