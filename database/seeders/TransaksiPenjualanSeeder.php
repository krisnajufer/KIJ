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
                "transaksi_penjualan_id" => "TP.C0001.19.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0001",
                "tanggal_penjualan" => "2019-04-11",
                "grand_total_penjualan" => 80000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.19.00002",
                "slug" => Str::random(16),
                "counter_id" => "C0001",
                "tanggal_penjualan" => "2019-08-11",
                "grand_total_penjualan" => 311500
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.19.00003",
                "slug" => Str::random(16),
                "counter_id" => "C0001",
                "tanggal_penjualan" => "2019-10-11",
                "grand_total_penjualan" => 58500
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0001",
                "tanggal_penjualan" => "2020-01-11",
                "grand_total_penjualan" => 256000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00002",
                "slug" => Str::random(16),
                "counter_id" => "C0001",
                "tanggal_penjualan" => "2020-11-02",
                "grand_total_penjualan" => 89000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.20.00003",
                "slug" => Str::random(16),
                "counter_id" => "C0001",
                "tanggal_penjualan" => "2020-12-24",
                "grand_total_penjualan" => 60000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.21.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0001",
                "tanggal_penjualan" => "2021-03-14",
                "grand_total_penjualan" => 156000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0001.21.00002",
                "slug" => Str::random(16),
                "counter_id" => "C0001",
                "tanggal_penjualan" => "2021-09-05",
                "grand_total_penjualan" => 79000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.19.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0002",
                "tanggal_penjualan" => "2019-02-19",
                "grand_total_penjualan" => 60000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.20.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0002",
                "tanggal_penjualan" => "2020-01-19",
                "grand_total_penjualan" => 311500
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.20.00002",
                "slug" => Str::random(16),
                "counter_id" => "C0002",
                "tanggal_penjualan" => "2020-02-29",
                "grand_total_penjualan" => 39000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.21.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0002",
                "tanggal_penjualan" => "2021-09-05",
                "grand_total_penjualan" => 79000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0002.21.00002",
                "slug" => Str::random(16),
                "counter_id" => "C0002",
                "tanggal_penjualan" => "2021-03-14",
                "grand_total_penjualan" => 156000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.19.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0003",
                "tanggal_penjualan" => "2019-06-12",
                "grand_total_penjualan" => 102500
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.19.00002",
                "slug" => Str::random(16),
                "counter_id" => "C0003",
                "tanggal_penjualan" => "2019-08-17",
                "grand_total_penjualan" => 67000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.20.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0003",
                "tanggal_penjualan" => "2020-01-23",
                "grand_total_penjualan" => 103000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.20.00002",
                "slug" => Str::random(16),
                "counter_id" => "C0003",
                "tanggal_penjualan" => "2020-02-20",
                "grand_total_penjualan" => 316000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0003.21.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0003",
                "tanggal_penjualan" => "2021-04-01",
                "grand_total_penjualan" => 279000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.19.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0004",
                "tanggal_penjualan" => "2019-04-01",
                "grand_total_penjualan" => 339000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.19.00002",
                "slug" => Str::random(16),
                "counter_id" => "C0004",
                "tanggal_penjualan" => "2019-08-01",
                "grand_total_penjualan" => 316000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.20.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0004",
                "tanggal_penjualan" => "2020-01-04",
                "grand_total_penjualan" => 103000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.20.00002",
                "slug" => Str::random(16),
                "counter_id" => "C0004",
                "tanggal_penjualan" => "2020-02-19",
                "grand_total_penjualan" => 204000
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.21.00001",
                "slug" => Str::random(16),
                "counter_id" => "C0004",
                "tanggal_penjualan" => "2021-04-19",
                "grand_total_penjualan" => 254500
            ],
            [
                "transaksi_penjualan_id" => "TP.C0004.21.00002",
                "slug" => Str::random(16),
                "counter_id" => "C0004",
                "tanggal_penjualan" => "2021-06-19",
                "grand_total_penjualan" => 127500
            ],
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
