<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $sub_counter_id = substr($counter_id, 3, 5);
        $kode = DB::table('transaksi_penjualan')->where('counter_id', '=', $counter_id)->max('transaksi_penjualan_id');
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

        $kodeBaru = "TP" . $sub_counter_id . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
