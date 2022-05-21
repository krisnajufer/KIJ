<?php

namespace App\Http\Controllers\Admin\Pengiriman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Counter;
use App\Models\Admin\Pengiriman;
use App\Models\Admin\DetailPengiriman;
use App\Models\Admin\Barang;
use App\Models\Admin\Permintaan;
use App\Models\Admin\User;

class PengirimanController extends Controller
{
    public function index()
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang') {

            $pengirimans = Pengiriman::select('pengiriman.pengiriman_id', 'p.permintaan_id', 'u.name', 'p.status', 'pengiriman.tanggal_pengiriman', 'pengiriman.slug')
                ->join('permintaan as p', 'pengiriman.permintaan_id', '=', 'p.permintaan_id')
                ->join('counter as c', 'p.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->where('p.status', 'Dikirim')
                ->orWhere('p.status', 'Diterima')
                ->orderBy('pengiriman.tanggal_pengiriman', 'DESC')
                ->get();

            return view('admin.pages.pengiriman.index', compact('pengirimans'));
        } elseif ($role == 'counter') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;

            $pengirimans = Pengiriman::select('pengiriman.pengiriman_id', 'p.permintaan_id', 'u.name', 'p.status', 'pengiriman.tanggal_pengiriman', 'pengiriman.slug')
                ->join('permintaan as p', 'pengiriman.permintaan_id', '=', 'p.permintaan_id')
                ->join('counter as c', 'p.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                // ->where('p.status', 'Dikirim')
                // ->orWhere('p.status', 'Diterima')
                ->where('p.counter_id', $counter_id)
                ->where('p.status', '<>', 'Pending')
                ->where('p.status', '<>', 'Proses')
                ->orderBy('pengiriman.tanggal_pengiriman', 'DESC')
                ->get();

            return view('admin.pages.pengiriman.index', compact('pengirimans'));
        }
    }

    public function show($slug)
    {
        $pengirimans = Pengiriman::where('slug', $slug)->first();
        $pengiriman_id = $pengirimans->pengiriman_id;

        $details = DetailPengiriman::leftjoin('pengiriman as p', 'detail_pengiriman.pengiriman_id', '=', 'p.pengiriman_id')
            ->leftjoin('barang as b', 'detail_pengiriman.barang_id', '=', 'b.barang_id')
            ->leftjoin('counter as c', 'detail_pengiriman.counter_id', '=', 'c.counter_id')
            ->leftjoin('users as u', 'c.user_id', '=', 'u.user_id')
            ->where('detail_pengiriman.pengiriman_id', $pengiriman_id)
            ->get();

        return view('admin.pages.pengiriman.detail', compact('details', 'pengiriman_id'));
    }
}
