<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Administrator
        DB::table('users')->insert([
            'user_code' => 'USR001',
            'name' => 'Super Administrator',
            'username' => 'superadmin',
            'email' => 'superadmin@company.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'role_id' => 2,
            'status' => 'aktif',
            'is_blocked' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Administrator
        DB::table('users')->insert([
            'user_code' => 'USR002',
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@company.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'role_id' => 1,
            'status' => 'aktif',
            'is_blocked' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pimpinan
        DB::table('users')->insert([
            'user_code' => 'USR003',
            'name' => 'Pimpinan Kominfo',
            'username' => 'pimpinan',
            'email' => 'pimpinan@company.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'role_id' => 3,
            'status' => 'aktif',
            'is_blocked' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
