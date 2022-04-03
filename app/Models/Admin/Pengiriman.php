<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Permintaan;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'pengiriman_id', 'slug', 'permintaan_id', 'tanggal_pengiriman', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'permintaan_id'
    ];

    protected $primaryKey = 'pengiriman_id';
    protected $keyType = 'string';

    public static function kode($permintaan_id)
    {
        $permintaans = Permintaan::where('permintaan_id', $permintaan_id)->first();
        $counter_id = $permintaans->counter_id;
        $sub_counter_id = substr($counter_id, 3, 5);
        $kode = DB::table('pengiriman')->join('permintaan', 'pengiriman.permintaan_id', '=', 'permintaan.permintaan_id')
            ->where('permintaan.counter_id', '=', $counter_id)->max('pengiriman_id');
        $addNol = '';
        $kode = substr($kode, 4, 8);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode) == 3) {
            $addNol = "0";
        }

        $kodeBaru = "SC" . $sub_counter_id . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
