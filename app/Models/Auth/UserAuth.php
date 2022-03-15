<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class UserAuth extends  Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name', 'slug', 'username', 'password', 'role', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'user_id', 'password',
    ];

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public function getAuthPassword()
    {
        return $this->password;
    }

    public static function kode()
    {
        $kode = DB::table('users')->max('user_id');
        $addNol = '';
        $kode = str_replace("U", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode) == 3) {
            $addNol = "0";
        }

        $kodeBaru = "U" . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
