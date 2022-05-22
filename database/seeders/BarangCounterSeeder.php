<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\BarangCounter;

class BarangCounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = (object)[
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0001B0001",
                "barang_id" => "B0001",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0001B0002",
                "barang_id" => "B0002",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0001B0003",
                "barang_id" => "B0003",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0001B0004",
                "barang_id" => "B0004",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0001B0005",
                "barang_id" => "B0005",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0001B0006",
                "barang_id" => "B0006",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0001B0007",
                "barang_id" => "B0007",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0001B0008",
                "barang_id" => "B0008",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0001B0009",
                "barang_id" => "B0009",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "barang_counter_id" => "C0001B0010",
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_id" => "B0010",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0002B0001",
                "barang_id" => "B0001",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0002B0002",
                "barang_id" => "B0002",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0002B0003",
                "barang_id" => "B0003",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0002B0004",
                "barang_id" => "B0004",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0002B0005",
                "barang_id" => "B0005",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0002B0006",
                "barang_id" => "B0006",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0002B0007",
                "barang_id" => "B0007",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0002B0008",
                "barang_id" => "B0008",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0002B0009",
                "barang_id" => "B0009",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "barang_counter_id" => "C0002B0010",
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_id" => "B0010",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0003B0001",
                "barang_id" => "B0001",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0003B0002",
                "barang_id" => "B0002",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0003B0003",
                "barang_id" => "B0003",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0003B0004",
                "barang_id" => "B0004",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0003B0005",
                "barang_id" => "B0005",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0003B0006",
                "barang_id" => "B0006",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0003B0007",
                "barang_id" => "B0007",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0003B0008",
                "barang_id" => "B0008",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0003B0009",
                "barang_id" => "B0009",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "barang_counter_id" => "C0003B0010",
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_id" => "B0010",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0004B0001",
                "barang_id" => "B0001",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0004B0002",
                "barang_id" => "B0002",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0004B0003",
                "barang_id" => "B0003",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0004B0004",
                "barang_id" => "B0004",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0004B0005",
                "barang_id" => "B0005",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0004B0006",
                "barang_id" => "B0006",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0004B0007",
                "barang_id" => "B0007",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0004B0008",
                "barang_id" => "B0008",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "C0004B0009",
                "barang_id" => "B0009",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "barang_counter_id" => "C0004B0010",
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_id" => "B0010",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $barangs = new BarangCounter;
                $barangs->barang_counter_id = $seed["barang_counter_id"];
                $barangs->slug = $seed["slug"];
                $barangs->barang_id = $seed["barang_id"];
                $barangs->counter_id = $seed["counter_id"];
                $barangs->barang_counter_stok = $seed["barang_counter_stok"];
                $barangs->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
