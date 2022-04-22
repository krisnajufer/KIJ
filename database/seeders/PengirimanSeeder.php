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
                "pengiriman_id" => "SC010001",
                "slug" => \Illuminate\Support\Str::random(16),
                "permintaan_id" => "RC010001",
                "tanggal_pengiriman" => Carbon::now(),
            ],
            [
                "pengiriman_id" => "SC020001",
                "slug" => \Illuminate\Support\Str::random(16),
                "permintaan_id" => "RC020001",
                "tanggal_pengiriman" => Carbon::now(),
            ],
            [
                "pengiriman_id" => "SC030001",
                "slug" => \Illuminate\Support\Str::random(16),
                "permintaan_id" => "RC030001",
                "tanggal_pengiriman" => Carbon::now(),
            ],
            [
                "pengiriman_id" => "SC040001",
                "slug" => \Illuminate\Support\Str::random(16),
                "permintaan_id" => "RC040001",
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
