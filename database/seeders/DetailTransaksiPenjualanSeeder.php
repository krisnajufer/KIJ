<?php

namespace Database\Seeders;

use App\Models\Admin\DetailTransaksiPenjualan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTransaksiPenjualanSeeder extends Seeder
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
                "barang_counter_id" => "C0001B0001",
                "qty_penjualan" => 5,
                "subtotal_penjualan" => "20000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00001",
                "barang_counter_id" => "C0001B0002",
                "qty_penjualan" => 4,
                "subtotal_penjualan" => "20000"
            ],
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $detail_transaksi_penjualan = new DetailTransaksiPenjualan;
                $detail_transaksi_penjualan->transaksi_penjualan_id = $seed["transaksi_penjualan_id"];
                $detail_transaksi_penjualan->barang_counter_id = $seed["barang_counter_id"];
                $detail_transaksi_penjualan->qty_penjualan = $seed["qty_penjualan"];
                $detail_transaksi_penjualan->subtotal_penjualan = $seed["subtotal_penjualan"];
                $detail_transaksi_penjualan->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
