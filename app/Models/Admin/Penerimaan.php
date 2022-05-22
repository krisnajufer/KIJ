<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Pengiriman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
        $now = Carbon::now();
        $year = date('Y', strtotime($now));
        $sub_year = substr($year, 2);

        $query = "SELECT MAX(penerimaan_id) as max from penerimaan where substr(penerimaan_id, 10,2) = '" . $sub_year . "' and substr(penerimaan_id, 4,5) ='" . $counter_id . "'";
        $datas = DB::select($query);

        foreach ($datas as $key => $data) {
            $max = $data->max;
        }

        $addNol = '';
        $kode = substr($max, 13, 5);
        $kode = (int)$kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "0000";
        } elseif (strlen($kode) == 2) {
            $addNol = "000";
        } elseif (strlen($kode) == 3) {
            $addNol = "00";
        } elseif (strlen($kode) == 4) {
            $addNol = "0";
        }

        $kodeBaru = "PN" . '.' . $counter_id . '.' . $sub_year . '.' . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
