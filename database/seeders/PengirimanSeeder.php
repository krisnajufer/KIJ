<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Pengiriman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PengirimanSeeder extends Seeder
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
                "slug" => \Illuminate\Support\Str::random(16),
                "permintaan_id" => "PM.C0001.22.00001",
                "tanggal_pengiriman" => Carbon::now(),
            ],
            [
                "pengiriman_id" => "PG.C0002.22.00001",
                "slug" => \Illuminate\Support\Str::random(16),
                "permintaan_id" => "PM.C0002.22.00001",
                "tanggal_pengiriman" => Carbon::now(),
            ],
            [
                "pengiriman_id" => "PG.C0003.22.00001",
                "slug" => \Illuminate\Support\Str::random(16),
                "permintaan_id" => "PM.C0003.22.00001",
                "tanggal_pengiriman" => Carbon::now(),
            ],
            [
                "pengiriman_id" => "PG.C0004.22.00001",
                "slug" => \Illuminate\Support\Str::random(16),
                "permintaan_id" => "PM.C0004.22.00001",
                "tanggal_pengiriman" => Carbon::now(),
            ]
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $pengirimans = new Pengiriman;
                $pengirimans->pengiriman_id = $seed["pengiriman_id"];
                $pengirimans->slug = $seed["slug"];
                $pengirimans->permintaan_id = $seed["permintaan_id"];
                $pengirimans->tanggal_pengiriman = $seed["tanggal_pengiriman"];
                $pengirimans->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
