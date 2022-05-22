<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Counter;

class CounterSeeder extends Seeder
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
                "slug" => \Illuminate\Support\Str::random(16),
                "user_id" => "U0002",
                "alamat_counter" => "Jl. Keputih Tegal No.29, Kota Surabaya, Jawa Timur",
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "user_id" => "U0003",
                "alamat_counter" => "Jl. Raya Wiyung No.674, Kota Surabaya, Jawa Timur",

            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "user_id" => "U0004",
                "alamat_counter" => "Jl. Rungkut Asri Tengah No.21, Kota Surabaya, Jawa Timur",

            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "user_id" => "U0005",
                "alamat_counter" => "JL. Kendangsari No.7C, Kota Surabaya, Jawa Timur",

            ],
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $kode = Counter::kode();
                $counter = new Counter;
                $counter->counter_id = $kode;
                $counter->slug = $seed["slug"];
                $counter->user_id = $seed["user_id"];
                $counter->alamat_counter = $seed["alamat_counter"];
                $counter->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
