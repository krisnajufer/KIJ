<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Klasifikasi extends Model
{
    use HasFactory;
    protected $table = 'klasifikasi';

    protected $fillable = [
        'klasifikasi_id', 'slug', 'counter_id', 'gudang_id', 'tgl_mulai_klasifikasi', 'tgl_akhir_klasifikasi', 'total_biaya_pertahun', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'counter_id'
    ];

    protected $primaryKey = 'klasifikasi_id';
    protected $keyType = 'string';

    public static function kode()
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $gudang = Gudang::where('user_id', $user_id)->first();
            $gudang_id = $gudang->gudang_id;
            $sub_gudang_id = substr($gudang_id, 3, 5);
            $kode = DB::table('klasifikasi')->where('gudang_id', '=', $gudang_id)->max('klasifikasi_id');
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

            $kodeBaru = "KLG" . $sub_gudang_id . $addNol . $incrementKode;
            return $kodeBaru;
        } elseif ($role == 'counter') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $counter = Counter::where('user_id', $user_id)->first();
            $counter_id = $counter->counter_id;
            $sub_counter_id = substr($counter_id, 3, 5);
            $kode = DB::table('klasifikasi')->where('counter_id', '=', $counter_id)->max('klasifikasi_id');
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

            $kodeBaru = "KLC" . $sub_counter_id . $addNol . $incrementKode;
            return $kodeBaru;
        }
    }
}
