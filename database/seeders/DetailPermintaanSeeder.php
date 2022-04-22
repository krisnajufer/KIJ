<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\DetailPermintaan;
use Illuminate\Support\Facades\DB;

class DetailPermintaanSeeder extends Seeder
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
                "permintaan_id" => "RC010001",
                "barang_id" => "B0001",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC010001",
                "barang_id" => "B0002",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC010001",
                "barang_id" => "B0003",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC010001",
                "barang_id" => "B0004",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC010001",
                "barang_id" => "B0005",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC010001",
                "barang_id" => "B0006",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC010001",
                "barang_id" => "B0007",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC010001",
                "barang_id" => "B0008",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC010001",
                "barang_id" => "B0009",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC010001",
                "barang_id" => "B0010",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC020001",
                "barang_id" => "B0001",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC020001",
                "barang_id" => "B0002",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC020001",
                "barang_id" => "B0003",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC020001",
                "barang_id" => "B0004",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC020001",
                "barang_id" => "B0005",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC020001",
                "barang_id" => "B0006",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC020001",
                "barang_id" => "B0007",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC020001",
                "barang_id" => "B0008",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC020001",
                "barang_id" => "B0009",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC020001",
                "barang_id" => "B0010",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC030001",
                "barang_id" => "B0001",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC030001",
                "barang_id" => "B0002",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC030001",
                "barang_id" => "B0003",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC030001",
                "barang_id" => "B0004",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC030001",
                "barang_id" => "B0005",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC030001",
                "barang_id" => "B0006",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC030001",
                "barang_id" => "B0007",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC030001",
                "barang_id" => "B0008",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC030001",
                "barang_id" => "B0009",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC030001",
                "barang_id" => "B0010",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC040001",
                "barang_id" => "B0001",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC040001",
                "barang_id" => "B0002",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC040001",
                "barang_id" => "B0003",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC040001",
                "barang_id" => "B0004",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC040001",
                "barang_id" => "B0005",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC040001",
                "barang_id" => "B0006",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC040001",
                "barang_id" => "B0007",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC040001",
                "barang_id" => "B0008",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC040001",
                "barang_id" => "B0009",
                "jumlah_permintaan" => 50,
            ],
            [
                "permintaan_id" => "RC040001",
                "barang_id" => "B0010",
                "jumlah_permintaan" => 50,
            ],
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $details = new DetailPermintaan;
                $details->permintaan_id = $seed["permintaan_id"];
                $details->barang_id = $seed["barang_id"];
                $details->jumlah_permintaan = $seed["jumlah_permintaan"];
                $details->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
