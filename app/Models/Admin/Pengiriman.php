<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Permintaan;
use Illuminate\Support\Carbon;

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
        $now = Carbon::now();
        $year = date('Y', strtotime($now));
        $sub_year = substr($year, 2);

        $query = "SELECT MAX(pengiriman_id) as max from pengiriman where substr(pengiriman_id, 10,2) = '" . $sub_year . "' and permintaan_id = '" . $permintaan_id . "'";
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

        $kodeBaru = "PG" . '.' . $counter_id . '.' . $sub_year . '.' . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
