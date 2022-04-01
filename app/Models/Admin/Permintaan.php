<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';

    protected $fillable = [
        'permintaan_id', 'slug', 'counter_id', 'tanggal_permintaan', 'status', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'user_id'
    ];

    protected $primaryKey = 'permintaan_id';
    protected $keyType = 'string';

    public static function kode()
    {
        $user_id = Auth::guard('admin')->user()->user_id;
        $counter = Counter::where('user_id', $user_id)->first();
        $counter_id = $counter->counter_id;
        $sub_counter_id = substr($counter_id, 3, 5);
        $kode = DB::table('permintaan')->where('counter_id', '=', $counter_id)->max('permintaan_id');
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

        $kodeBaru = "RC" . $sub_counter_id . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
