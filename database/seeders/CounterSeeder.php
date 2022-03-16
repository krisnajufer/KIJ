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
                "alamat_counter" => "Jl. Ahmad Yani",
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "user_id" => "U0003",
                "alamat_counter" => "Jl. Kertayaja",

            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "user_id" => "U0004",
                "alamat_counter" => "Jl. Sutorejo",

            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "user_id" => "U0005",
                "alamat_counter" => "Jl. Pondok Benowo Indah",

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
