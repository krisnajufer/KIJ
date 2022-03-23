<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gudang extends Model
{
    use HasFactory;
    protected $table = 'gudang';

    protected $fillable = [
        'gudang_id', 'slug', 'user_id', 'alamat_gudang', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'user_id'
    ];

    protected $primaryKey = 'gudang_id';
    protected $keyType = 'string';

    public static function kode()
    {
        $kode = DB::table('gudang')->max('gudang_id');
        $addNol = '';
        $kode = str_replace("G", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode) == 3) {
            $addNol = "0";
        }

        $kodeBaru = "G" . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
