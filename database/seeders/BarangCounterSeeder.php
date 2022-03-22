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
                "barang_counter_id" => "BC010001",
                "barang_id" => "B0001",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC010002",
                "barang_id" => "B0002",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC010003",
                "barang_id" => "B0003",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC010004",
                "barang_id" => "B0004",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC010005",
                "barang_id" => "B0005",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC010006",
                "barang_id" => "B0006",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC010007",
                "barang_id" => "B0007",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC010008",
                "barang_id" => "B0008",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC010009",
                "barang_id" => "B0009",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "barang_counter_id" => "BC010010",
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_id" => "B0010",
                "barang_counter_stok" => 50,
                "counter_id" => "C0001"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC020001",
                "barang_id" => "B0001",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC020002",
                "barang_id" => "B0002",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC020003",
                "barang_id" => "B0003",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC020004",
                "barang_id" => "B0004",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC020005",
                "barang_id" => "B0005",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC020006",
                "barang_id" => "B0006",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC020007",
                "barang_id" => "B0007",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC020008",
                "barang_id" => "B0008",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC020009",
                "barang_id" => "B0009",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "barang_counter_id" => "BC020010",
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_id" => "B0010",
                "barang_counter_stok" => 50,
                "counter_id" => "C0002"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC030001",
                "barang_id" => "B0001",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC030002",
                "barang_id" => "B0002",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC030003",
                "barang_id" => "B0003",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC030004",
                "barang_id" => "B0004",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC030005",
                "barang_id" => "B0005",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC030006",
                "barang_id" => "B0006",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC030007",
                "barang_id" => "B0007",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC030008",
                "barang_id" => "B0008",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC030009",
                "barang_id" => "B0009",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "barang_counter_id" => "BC030010",
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_id" => "B0010",
                "barang_counter_stok" => 50,
                "counter_id" => "C0003"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC040001",
                "barang_id" => "B0001",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC040002",
                "barang_id" => "B0002",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC040003",
                "barang_id" => "B0003",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC040004",
                "barang_id" => "B0004",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC040005",
                "barang_id" => "B0005",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC040006",
                "barang_id" => "B0006",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC040007",
                "barang_id" => "B0007",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC040008",
                "barang_id" => "B0008",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "barang_counter_id" => "BC040009",
                "barang_id" => "B0009",
                "barang_counter_stok" => 50,
                "counter_id" => "C0004"
            ],
            [
                "barang_counter_id" => "BC040010",
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
