<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Auth\UserAuth;

class UsersSeeder extends Seeder
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
                "name" => "Gudang",
                "role" => "gudang",
                "username" => "gudang",
                "password" => bcrypt("gudang"),

            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "name" => "Counter 1",
                "role" => "counter",
                "username" => "counter1",
                "password" => bcrypt("counter"),

            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "name" => "Counter 2",
                "role" => "counter",
                "username" => "counter2",
                "password" => bcrypt("counter"),

            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "name" => "Counter 3",
                "role" => "counter",
                "username" => "counter3",
                "password" => bcrypt("counter"),

            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "name" => "Counter 4",
                "role" => "counter",
                "username" => "counter4",
                "password" => bcrypt("counter"),

            ],

            [
                "slug" => \Illuminate\Support\Str::random(16),
                "name" => "Owner",
                "role" => "owner",
                "username" => "owner",
                "password" => bcrypt("owner"),

            ],
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $kode = UserAuth::kode();
                $users = new UserAuth;
                $users->user_id = $kode;
                $users->slug = $seed["slug"];
                $users->name = $seed["name"];
                $users->role = $seed["role"];
                $users->username = $seed["username"];
                $users->password = $seed["password"];
                $users->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
