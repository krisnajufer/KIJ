<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Gudang;
use Illuminate\Support\Facades\DB;

class GudangSeeder extends Seeder
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
                "user_id" => "U0001",
                "alamat_gudang" => "Surabaya"
            ]
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $kode = Gudang::kode();
                $gudangs = new Gudang;
                $gudangs->gudang_id = $kode;
                $gudangs->slug = $seed["slug"];
                $gudangs->user_id = $seed["user_id"];
                $gudangs->alamat_gudang = $seed["alamat_gudang"];
                $gudangs->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
