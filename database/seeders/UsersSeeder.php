<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama_pengguna' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'no_hp' => '081234567890',
                'no_ktp' => '1234567890123456',
                'alamat' => 'Jl. Raya No. 1',
                'role' => 'admin',
            ],
            [
                'nama_pengguna' => 'dokter',
                'username' => 'dokter',
                'password' => bcrypt('dokter'),
                'no_hp' => '081234567890',
                'no_ktp' => '1234567890123456',
                'alamat' => 'Jl. Raya No. 1',
                'role' => 'dokter',
            ]
        ]);
    }
}
