<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Pengiriman;
use Illuminate\Support\Facades\DB;

class Penerimaan extends Model
{
    use HasFactory;

    protected $table = 'penerimaan';

    protected $fillable = [
        'penerimaan_id', 'slug', 'pengiriman_id', 'counter_id', 'tanggal_penerimaan', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'permintaan_id'
    ];

    protected $primaryKey = 'penerimaan_id';
    protected $keyType = 'string';

    public static function kode($pengiriman_id)
    {
        $pengirimans = Pengiriman::join('permintaan as pm', 'pengiriman.permintaan_id', '=', 'pm.permintaan_id')
            ->where('pengiriman.pengiriman_id', $pengiriman_id)
            ->first();
        $counter_id = $pengirimans->counter_id;
        $sub_counter_id = substr($counter_id, 3, 5);
        $kode = DB::table('penerimaan')->where('counter_id', '=', $counter_id)->max('penerimaan_id');
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

        $kodeBaru = "KC" . $sub_counter_id . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
