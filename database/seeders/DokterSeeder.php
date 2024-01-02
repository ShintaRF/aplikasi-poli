<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dokters')->insert([
            [
                'nama' => 'Dr. Andi',
                'alamat' => 'Jl. Raya No. 2',
                'no_hp' => '081234567890',
                'id_poli' => 1,
            ],
            [
                'nama' => 'Dr. Budi',
                'alamat' => 'Jl. Raya No. 3',
                'no_hp' => '081234567891',
                'id_poli' => 2,
            ],
            [
                'nama' => 'Dr. Caca',
                'alamat' => 'Jl. Raya No. 4',
                'no_hp' => '081234567892',
                'id_poli' => 3,
            ],

        ]);
    }
}
