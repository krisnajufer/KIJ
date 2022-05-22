<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\DetailPengiriman;
use Illuminate\Support\Facades\DB;

class DetailPengirimanSeeder extends Seeder
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
                "pengiriman_id" => "PG.C0001.22.00001",
                "barang_id" => "B0001",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0001.22.00001",
                "barang_id" => "B0002",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0001.22.00001",
                "barang_id" => "B0003",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0001.22.00001",
                "barang_id" => "B0004",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0001.22.00001",
                "barang_id" => "B0005",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0001.22.00001",
                "barang_id" => "B0006",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0001.22.00001",
                "barang_id" => "B0007",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0001.22.00001",
                "barang_id" => "B0008",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0001.22.00001",
                "barang_id" => "B0009",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0001.22.00001",
                "barang_id" => "B0010",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "barang_id" => "B0001",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "barang_id" => "B0002",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "barang_id" => "B0003",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "barang_id" => "B0004",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "barang_id" => "B0005",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "barang_id" => "B0006",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "barang_id" => "B0007",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "barang_id" => "B0008",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "barang_id" => "B0009",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "barang_id" => "B0010",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "barang_id" => "B0001",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "barang_id" => "B0002",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "barang_id" => "B0003",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "barang_id" => "B0004",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "barang_id" => "B0005",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "barang_id" => "B0006",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "barang_id" => "B0007",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "barang_id" => "B0008",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "barang_id" => "B0009",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "barang_id" => "B0010",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "barang_id" => "B0001",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "barang_id" => "B0002",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "barang_id" => "B0003",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "barang_id" => "B0004",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "barang_id" => "B0005",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "barang_id" => "B0006",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "barang_id" => "B0007",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "barang_id" => "B0008",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "barang_id" => "B0009",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "barang_id" => "B0010",
                "jumlah_pengiriman" => 50,
                "sumber" => "gudang",
                "gudang_id" => "G0001",
                "counter_id" => "",
                "persetujuan" => "Setuju",
                "alasan" => "-"
            ],
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $details = new DetailPengiriman;
                $details->pengiriman_id = $seed["pengiriman_id"];
                $details->barang_id = $seed["barang_id"];
                $details->jumlah_pengiriman = $seed["jumlah_pengiriman"];
                $details->sumber = $seed["sumber"];
                $details->gudang_id = $seed["gudang_id"];
                $details->counter_id = $seed["counter_id"];
                $details->persetujuan = $seed["persetujuan"];
                $details->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
