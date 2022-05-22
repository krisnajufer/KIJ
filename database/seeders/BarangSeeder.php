<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Barang;

class BarangSeeder extends Seeder
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
                "nama_barang" => "Pensil 2B Faber Castell",
                "stok_barang" => 100,
                "harga_barang" => 4000
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Penghapus Faber Castell",
                "stok_barang" => 100,
                "harga_barang" => 5000
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Penggaris Faber Castell 30 CM",
                "stok_barang" => 100,
                "harga_barang" => 7500
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Pulpoin Faber Castell gel 0.7",
                "stok_barang" => 100,
                "harga_barang" => 9500
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Tipe-X Faber Castell Cair 3ml",
                "stok_barang" => 100,
                "harga_barang" => 5000
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Rautan Faber Castell 125 LV",
                "stok_barang" => 100,
                "harga_barang" => 5500
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Pensil Warna Faber Castell 48 Classic",
                "stok_barang" => 100,
                "harga_barang" => 68000
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Expanding File Map Harmonika Joyko EF-2638 Folio 13 Pocket",
                "stok_barang" => 100,
                "harga_barang" => 51000
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Buku Tulis Sidu 38 Lembar",
                "stok_barang" => 100,
                "harga_barang" => 4000
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Buku Gambar Sidu",
                "stok_barang" => 100,
                "harga_barang" => 8000
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Double Tape Joyko",
                "stok_barang" => 100,
                "harga_barang" => 7500
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Tas Palazzo",
                "stok_barang" => 100,
                "harga_barang" => 150000
            ],
            [
                "slug" => \Illuminate\Support\Str::random(16),
                "nama_barang" => "Tas Export",
                "stok_barang" => 100,
                "harga_barang" => 200000
            ],
        ];

        foreach ($seeds as $seed) {
            DB::beginTransaction();
            try {
                $kode = Barang::kode();
                $barangs = new Barang;
                $barangs->barang_id = $kode;
                $barangs->slug = $seed["slug"];
                $barangs->nama_barang = $seed["nama_barang"];
                $barangs->stok_barang = $seed["stok_barang"];
                $barangs->harga_barang = $seed["harga_barang"];
                $barangs->save();
                DB::commit();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
                DB::rollBack();
            }
        }
    }
}
