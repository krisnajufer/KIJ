<?php

namespace Database\Seeders;

use App\Models\Admin\Penerimaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PenerimaanSeeder extends Seeder
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
                "penerimaan_id" => "KC010001",
                "slug" => \Illuminate\Support\Str::random(16),
                "pengiriman_id" => "SC010001",
                "counter_id" => "C0001",
                "tanggal_penerimaan" => Carbon::now(),
            ],
            [
                "penerimaan_id" => "KC020001",
                "slug" => \Illuminate\Support\Str::random(16),
                "pengiriman_id" => "SC020001",
                "counter_id" => "C0002",
                "tanggal_penerimaan" => Carbon::now(),
            ],
            [
                "penerimaan_id" => "KC030001",
                "slug" => \Illuminate\Support\Str::random(16),
                "pengiriman_id" => "SC030001",
                "counter_id" => "C0003",
                "tanggal_penerimaan" => Carbon::now(),
            ],
            [
                "penerimaan_id" => "KC040001",
                "slug" => \Illuminate\Support\Str::random(16),
                "pengiriman_id" => "SC040001",
                "counter_id" => "C0004",
                "tanggal_penerimaan" => Carbon::now(),
            ]
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $penerimaans = new Penerimaan;
                $penerimaans->penerimaan_id = $seed["penerimaan_id"];
                $penerimaans->slug = $seed["slug"];
                $penerimaans->pengiriman_id = $seed["pengiriman_id"];
                $penerimaans->counter_id = $seed["counter_id"];
                $penerimaans->tanggal_penerimaan = $seed["tanggal_penerimaan"];
                $penerimaans->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
