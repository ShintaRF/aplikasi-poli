<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersSeeder::class);
        $this->call(PoliSeeder::class);
        $this->call(ObatSeeder::class);
        $this->call(DokterSeeder::class);
        $this->call(JadwalSeeder::class);
    }
}
