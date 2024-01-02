<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obats')->insert([
            [
                'nama_obat' => 'Paramex',
                'kemasan' => 'Strip',
                'harga' => '5500',
            ],
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Strip',
                'harga' => '20000',
            ],
            [
                'nama_obat' => 'Citirizen',
                'kemasan' => 'Strip',
                'harga' => '5000',
            ]
        ]);
    }
}
