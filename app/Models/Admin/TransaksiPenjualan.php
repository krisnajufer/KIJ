<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TransaksiPenjualan extends Model
{
    use HasFactory;
    protected $table = 'transaksi_penjualan';

    protected $fillable = [
        'transaksi_penjualan_id', 'slug', 'counter_id', 'tanggal_penjualan', 'grand_total_penjualan', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'counter_id'
    ];

    protected $primaryKey = 'transaksi_penjualan_id';
    protected $keyType = 'string';

    public static function kode()
    {
        $user_id = Auth::guard('admin')->user()->user_id;
        $counter = Counter::where('user_id', $user_id)->first();
        $counter_id = $counter->counter_id;
        $now = Carbon::now();
        $year = date('Y', strtotime($now));
        $sub_year = substr($year, 2);

        $query = "SELECT MAX(transaksi_penjualan_id) as max from transaksi_penjualan where substr(transaksi_penjualan_id, 10,2) = '" . $sub_year . "' and counter_id = '" . $counter_id . "'";
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

        $kodeBaru = "TP" . '.' . $counter_id . '.' . $sub_year . '.' . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
