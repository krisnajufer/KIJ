<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Counter extends Model
{
    use HasFactory;
    protected $table = 'counter';

    protected $fillable = [
        'counter_id', 'slug', 'user_id', 'alamat_counter', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'user_id'
    ];

    protected $primaryKey = 'counter_id';
    protected $keyType = 'string';

    public static function kode()
    {
        $kode = DB::table('counter')->max('counter_id');
        $addNol = '';
        $kode = str_replace("C", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode) == 3) {
            $addNol = "0";
        }

        $kodeBaru = "C" . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
