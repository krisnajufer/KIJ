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
                "transaksi_penjualan_id" => "TP.C0001.19.00001",
                "barang_counter_id" => "C0001B0001",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.19.00001",
                "barang_counter_id" => "C0001B0002",
                "qty_penjualan" => 4,
                "subtotal_penjualan" => "20000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.19.00002",
                "barang_counter_id" => "C0001B0003",
                "qty_penjualan" => 3,
                "subtotal_penjualan" => "22500"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.19.00002",
                "barang_counter_id" => "C0001B0005",
                "qty_penjualan" => 5,
                "subtotal_penjualan" => "25000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.19.00002",
                "barang_counter_id" => "C0001B0008",
                "qty_penjualan" => 4,
                "subtotal_penjualan" => "204000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.19.00002",
                "barang_counter_id" => "C0001B0003",
                "qty_penjualan" => 8,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.19.00003",
                "barang_counter_id" => "C0001B0004",
                "qty_penjualan" => 5,
                "subtotal_penjualan" => "47500"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.19.00003",
                "barang_counter_id" => "C0001B0006",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "11000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00001",
                "barang_counter_id" => "C0001B0007",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "136000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00001",
                "barang_counter_id" => "C0001B0010",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "120000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00002",
                "barang_counter_id" => "C0001B0009",
                "qty_penjualan" => 7,
                "subtotal_penjualan" => "28000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00002",
                "barang_counter_id" => "C0001B0008",
                "qty_penjualan" => 1,
                "subtotal_penjualan" => "51000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00002",
                "barang_counter_id" => "C0001B0002",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "10000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00003",
                "barang_counter_id" => "C0001B0005",
                "qty_penjualan" => 1,
                "subtotal_penjualan" => "5000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00003",
                "barang_counter_id" => "C0001B0010",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "16000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00003",
                "barang_counter_id" => "C0001B0003",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "15000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00003",
                "barang_counter_id" => "C0001B0009",
                "qty_penjualan" => 6,
                "subtotal_penjualan" => "24000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.21.00001",
                "barang_counter_id" => "C0001B0007",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "136000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.21.00001",
                "barang_counter_id" => "C0001B0010",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "120000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.21.00002",
                "barang_counter_id" => "C0001B0009",
                "qty_penjualan" => 7,
                "subtotal_penjualan" => "28000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.21.00002",
                "barang_counter_id" => "C0001B0008",
                "qty_penjualan" => 1,
                "subtotal_penjualan" => "51000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.19.00001",
                "barang_counter_id" => "C0002B0005",
                "qty_penjualan" => 1,
                "subtotal_penjualan" => "5000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.19.00001",
                "barang_counter_id" => "C0002B0010",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "16000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.19.00001",
                "barang_counter_id" => "C0002B0003",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "15000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.19.00001",
                "barang_counter_id" => "C0002B0009",
                "qty_penjualan" => 6,
                "subtotal_penjualan" => "24000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.20.00001",
                "barang_counter_id" => "C0002B0003",
                "qty_penjualan" => 3,
                "subtotal_penjualan" => "22500"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.20.00001",
                "barang_counter_id" => "C0002B0005",
                "qty_penjualan" => 5,
                "subtotal_penjualan" => "25000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.20.00001",
                "barang_counter_id" => "C0002B0008",
                "qty_penjualan" => 4,
                "subtotal_penjualan" => "204000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.20.00001",
                "barang_counter_id" => "C0002B0003",
                "qty_penjualan" => 8,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.20.00002",
                "barang_counter_id" => "C0002B0003",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "15000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.20.00002",
                "barang_counter_id" => "C0002B0009",
                "qty_penjualan" => 6,
                "subtotal_penjualan" => "24000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.21.00001",
                "barang_counter_id" => "C0002B0009",
                "qty_penjualan" => 7,
                "subtotal_penjualan" => "28000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.21.00001",
                "barang_counter_id" => "C0002B0008",
                "qty_penjualan" => 1,
                "subtotal_penjualan" => "51000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.21.00002",
                "barang_counter_id" => "C0002B0007",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "136000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.21.00002",
                "barang_counter_id" => "C0002B0010",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "120000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.19.00001",
                "barang_counter_id" => "C0003B0001",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.19.00001",
                "barang_counter_id" => "C0003B0002",
                "qty_penjualan" => 4,
                "subtotal_penjualan" => "20000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.19.00001",
                "barang_counter_id" => "C0003B0003",
                "qty_penjualan" => 3,
                "subtotal_penjualan" => "22500"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.19.00002",
                "barang_counter_id" => "C0003B0003",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "15000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.19.00002",
                "barang_counter_id" => "C0003B0009",
                "qty_penjualan" => 6,
                "subtotal_penjualan" => "24000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.19.00002",
                "barang_counter_id" => "C0003B0009",
                "qty_penjualan" => 7,
                "subtotal_penjualan" => "28000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.20.00001",
                "barang_counter_id" => "C0003B0009",
                "qty_penjualan" => 6,
                "subtotal_penjualan" => "24000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.20.00001",
                "barang_counter_id" => "C0002B0009",
                "qty_penjualan" => 7,
                "subtotal_penjualan" => "28000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.20.00001",
                "barang_counter_id" => "C0003B0008",
                "qty_penjualan" => 1,
                "subtotal_penjualan" => "51000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.20.00002",
                "barang_counter_id" => "C0003B0007",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "136000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.20.00002",
                "barang_counter_id" => "C0003B0010",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "120000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.20.00002",
                "barang_counter_id" => "C0003B0001",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.21.00001",
                "barang_counter_id" => "C0003B0008",
                "qty_penjualan" => 4,
                "subtotal_penjualan" => "204000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.21.00001",
                "barang_counter_id" => "C0003B0003",
                "qty_penjualan" => 8,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.21.00001",
                "barang_counter_id" => "C0003B0003",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "15000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.19.00001",
                "barang_counter_id" => "C0004B0001",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.19.00001",
                "barang_counter_id" => "C0004B0008",
                "qty_penjualan" => 4,
                "subtotal_penjualan" => "204000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.19.00001",
                "barang_counter_id" => "C0004B0003",
                "qty_penjualan" => 8,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.19.00001",
                "barang_counter_id" => "C0004B0003",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "15000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.19.00002",
                "barang_counter_id" => "C0004B0007",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "136000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.19.00002",
                "barang_counter_id" => "C0004B0010",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "120000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.19.00002",
                "barang_counter_id" => "C0004B0001",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.20.00001",
                "barang_counter_id" => "C0004B0009",
                "qty_penjualan" => 6,
                "subtotal_penjualan" => "24000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.20.00001",
                "barang_counter_id" => "C0004B0009",
                "qty_penjualan" => 7,
                "subtotal_penjualan" => "28000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.20.00001",
                "barang_counter_id" => "C0004B0008",
                "qty_penjualan" => 1,
                "subtotal_penjualan" => "51000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.20.00002",
                "barang_counter_id" => "C0004B0010",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "120000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.20.00002",
                "barang_counter_id" => "C0004B0009",
                "qty_penjualan" => 7,
                "subtotal_penjualan" => "28000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.20.00002",
                "barang_counter_id" => "C0004B0008",
                "qty_penjualan" => 1,
                "subtotal_penjualan" => "51000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.20.00002",
                "barang_counter_id" => "C0004B0005",
                "qty_penjualan" => 1,
                "subtotal_penjualan" => "5000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.21.00001",
                "barang_counter_id" => "C0004B0003",
                "qty_penjualan" => 8,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.21.00001",
                "barang_counter_id" => "C0004B0004",
                "qty_penjualan" => 5,
                "subtotal_penjualan" => "47500"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.21.00001",
                "barang_counter_id" => "C0004B0006",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "11000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.21.00001",
                "barang_counter_id" => "C0004B0007",
                "qty_penjualan" => 2,
                "subtotal_penjualan" => "136000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.21.00002",
                "barang_counter_id" => "C0004B0001",
                "qty_penjualan" => 15,
                "subtotal_penjualan" => "60000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.21.00002",
                "barang_counter_id" => "C0004B0002",
                "qty_penjualan" => 4,
                "subtotal_penjualan" => "20000"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.21.00002",
                "barang_counter_id" => "C0004B0003",
                "qty_penjualan" => 3,
                "subtotal_penjualan" => "22500"
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.21.00002",
                "barang_counter_id" => "C0004B0005",
                "qty_penjualan" => 5,
                "subtotal_penjualan" => "25000"
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
