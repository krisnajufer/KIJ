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

    public static function kode($counter_id, $barang_id)
    {

        $kodeBaru = $counter_id . $barang_id;
        return $kodeBaru;
    }
}
