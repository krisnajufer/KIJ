<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Admin\Permintaan;
use Illuminate\Support\Facades\DB;

class PermintaanSeeder extends Seeder
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
                "permintaan_id" => "PM.C0004.22.00001",
                "slug" => \Illuminate\Support\Str::random(16),
                "counter_id" => "C0001",
                "tanggal_permintaan" => Carbon::now(),
                "status" => "Diterima"
            ],
            [
                "permintaan_id" => "PM.C0002.22.00001",
                "slug" => \Illuminate\Support\Str::random(16),
                "counter_id" => "C0002",
                "tanggal_permintaan" => Carbon::now(),
                "status" => "Diterima"
            ],
            [
                "permintaan_id" => "PM.C0003.22.00001",
                "slug" => \Illuminate\Support\Str::random(16),
                "counter_id" => "C0003",
                "tanggal_permintaan" => Carbon::now(),
                "status" => "Diterima"
            ],
            [
                "permintaan_id" => "PM.C0004.22.00001",
                "slug" => \Illuminate\Support\Str::random(16),
                "counter_id" => "C0004",
                "tanggal_permintaan" => Carbon::now(),
                "status" => "Diterima"
            ]
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $permintaans = new Permintaan;
                $permintaans->permintaan_id = $seed["permintaan_id"];
                $permintaans->slug = $seed["slug"];
                $permintaans->counter_id = $seed["counter_id"];
                $permintaans->tanggal_permintaan = $seed["tanggal_permintaan"];
                $permintaans->status = $seed["status"];
                $permintaans->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
