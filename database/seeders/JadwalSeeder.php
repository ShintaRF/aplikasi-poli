<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwals')->insert([
            [
                'hari' => 'Senin',
                'jam_mulai' => '08:00',
                'jam_selesai' => '12:00',
                'id_dokter' => 1,
            ],
            [
                'hari' => 'Selasa',
                'jam_mulai' => '08:00',
                'jam_selesai' => '12:00',
                'id_dokter' => 2,
            ],
            [
                'hari' => 'Rabu',
                'jam_mulai' => '08:00',
                'jam_selesai' => '12:00',
                'id_dokter' => 3,
            ],
            [
                'hari' => 'Kamis',
                'jam_mulai' => '08:00',
                'jam_selesai' => '12:00',
                'id_dokter' => 1,
            ],

        ]);
    }
}
