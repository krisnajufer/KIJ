<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'barang_id', 'slug', 'nama_barang', 'stok_barang', 'harga_barang', 'created_at', 'updated_at'
    ];

    public static function kode()
    {
        $kode = DB::table('barang')->max('barang_id');
        $addNol = '';
        $kode = str_replace("B", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode) == 3) {
            $addNol = "0";
        }

        $kodeBaru = "B" . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
