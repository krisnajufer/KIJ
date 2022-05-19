<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Counter;

class BarangCounter extends Model
{
    use HasFactory;
    protected $table = 'barang_counter';

    protected $fillable = [
        'barang_counter_id', 'slug', 'barang_id', 'counter_id', 'barang_counter_stok', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'barang_counter_id';
    protected $keyType = 'string';

    protected $hidden = [
        'barang_id'
    ];

    public static function kode($counter_id)
    {
        // $sub_counter_id = substr($counter_id, 3, 5);
        $kode = BarangCounter::where('counter_id', $counter_id)->max('barang_counter_id');
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

        $kodeBaru = "BC" . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
