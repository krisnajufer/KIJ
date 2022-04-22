<?php

namespace Database\Seeders;

use App\Models\Admin\DetailPengiriman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            UsersSeeder::class,
            CounterSeeder::class,
            BarangSeeder::class,
            BarangCounterSeeder::class,
            GudangSeeder::class,
            PermintaanSeeder::class,
            DetailPermintaanSeeder::class,
            PengirimanSeeder::class,
            DetailPengirimanSeeder::class,
            PenerimaanSeeder::class,
        ]);
    }
}
