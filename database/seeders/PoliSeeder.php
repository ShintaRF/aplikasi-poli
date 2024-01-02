<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('polis')->insert([
            [
                'nama_poli' => 'Umum',
                'keterangan' => 'Poli Umum',
            ],
            [
                'nama_poli' => 'Gigi',
                'keterangan' => 'Poli Gigi',
            ],
            [
                'nama_poli' => 'Anak',
                'keterangan' => 'Poli Anak',
            ],
            [
                'nama_poli' => 'Kandungan',
                'deskripsi' => 'Poli Kandungan',
            ],

        ]);
    }
}
