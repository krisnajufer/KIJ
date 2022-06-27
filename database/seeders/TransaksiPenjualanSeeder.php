<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\TransaksiPenjualan;

class TransaksiPenjualanSeeder extends Seeder
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
                "transaksi_penjualan_id" => "TP.C0001.20.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0001",
                "tanggal_penjualan" => "2020-08-11",
                "grand_total_penjualan" => 40000
            ]
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $transaksi_penjualan = new TransaksiPenjualan;
                $transaksi_penjualan->transaksi_penjualan_id = $seed["transaksi_penjualan_id"];
                $transaksi_penjualan->slug = $seed["slug"];
                $transaksi_penjualan->counter_id = $seed["counter_id"];
                $transaksi_penjualan->tanggal_penjualan = $seed["tanggal_penjualan"];
                $transaksi_penjualan->grand_total_penjualan = $seed["grand_total_penjualan"];
                $transaksi_penjualan->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
