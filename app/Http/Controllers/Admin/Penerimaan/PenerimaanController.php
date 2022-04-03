<?php

namespace App\Http\Controllers\Admin\Penerimaan;

use App\Http\Controllers\Controller;
use App\Models\Admin\Barang;
use App\Models\Admin\BarangCounter;
use Illuminate\Http\Request;
use App\Models\Admin\Pengiriman;
use App\Models\Admin\Penerimaan;
use App\Models\Admin\DetailPengiriman;
use App\Models\Admin\Permintaan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Counter;


class PenerimaanController extends Controller
{
    public function store($slug)
    {
        $pengirimans = Pengiriman::all()->where('slug', $slug)->first();
        $pengiriman_id = $pengirimans->pengiriman_id;
        $permintaan_id = $pengirimans->permintaan_id;
        $permintaans = Permintaan::where('permintaan_id', $permintaan_id)->first();
        $counter_id = $permintaans->counter_id;
        $kode = Penerimaan::kode($pengiriman_id);

        $details = DetailPengiriman::where('pengiriman_id', $pengiriman_id)->get();
        foreach ($details as $detail) {
            $cek_barang = BarangCounter::where(['barang_id' => $detail->barang_id, 'counter_id' => $counter_id])->count();
            if ($cek_barang > 0) {
                if ($detail->sumber == 'gudang') {
                    $barang_counters = BarangCounter::where(['barang_id' => $detail->barang_id, 'counter_id' => $counter_id])->first();
                    $barang_counters->barang_counter_stok = $barang_counters->barang_counter_stok + $detail->jumlah_pengiriman;
                    $barang_counters->save();
                    $barangs = Barang::where('barang_id', $detail->barang_id)->first();
                    $barangs->stok_barang = $barangs->stok_barang - $detail->jumlah_pengiriman;
                    $barangs->save();
                } elseif ($detail->sumber == 'counter') {
                    $barang_counters = BarangCounter::where(['barang_id' => $detail->barang_id, 'counter_id' => $counter_id])->first();
                    $barang_counters->barang_counter_stok = $barang_counters->barang_counter_stok + $detail->jumlah_pengiriman;
                    $barang_counters->save();
                    $barangs = BarangCounter::where(['barang_id' => $detail->barang_id, 'counter_id' => $detail->counter_id])->first();
                    $barangs->barang_counter_stok = $barangs->barang_counter_stok - $detail->jumlah_pengiriman;
                    $barangs->save();
                }
            } else {
                if ($detail->sumber == 'gudang') {
                    $barang_counters = new BarangCounter;
                    $kode_barangs = BarangCounter::kode($counter_id);
                    $barang_counters->barang_counter_id = $kode_barangs;
                    $barang_counters->slug =  \Illuminate\Support\Str::random(16);
                    $barang_counters->barang_id = $detail->barang_id;
                    $barang_counters->counter_id = $counter_id;
                    $barang_counters->barang_counter_stok = $detail->jumlah_pengiriman;
                    $barang_counters->save();
                    $barangs = Barang::where('barang_id', $detail->barang_id)->first();
                    $barangs->stok_barang = $barangs->stok_barang - $detail->jumlah_pengiriman;
                    $barangs->save();
                } elseif ($detail->sumber == 'counter') {
                    $barang_counters = new BarangCounter;
                    $kode_barangs = BarangCounter::kode($counter_id);
                    $barang_counters->barang_counter_id = $kode_barangs;
                    $barang_counters->slug =  \Illuminate\Support\Str::random(16);
                    $barang_counters->barang_id = $detail->barang_id;
                    $barang_counters->counter_id = $counter_id;
                    $barang_counters->barang_counter_stok = $detail->jumlah_pengiriman;
                    $barang_counters->save();
                    $barangs = BarangCounter::where(['barang_id' => $detail->barang_id, 'counter_id' => $detail->counter_id])->first();
                    $barangs->barang_counter_stok = $barangs->barang_counter_stok - $detail->jumlah_pengiriman;
                    $barangs->save();
                }
            }
        }

        $penerimaans = new Penerimaan;
        $penerimaans->penerimaan_id = $kode;
        $penerimaans->slug = \Illuminate\Support\Str::random(16);
        $penerimaans->pengiriman_id = $pengiriman_id;
        $penerimaans->counter_id = $counter_id;
        $penerimaans->tanggal_penerimaan = Carbon::now();
        $penerimaans->save();

        $permintaan = Permintaan::where('permintaan_id', $permintaan_id)->first();
        $permintaan->status = "Diterima";
        $permintaan->save();

        return redirect()->route('penerimaan');
    }

    public function index()
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang') {
            $penerimaans = Penerimaan::join('counter as c', 'penerimaan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->orderBy('penerimaan.tanggal_penerimaan', 'DESC')
                ->get();

            return view('admin.pages.penerimaan.index', compact('penerimaans'));
        } elseif ($role == 'counter') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;

            $penerimaans = Penerimaan::join('counter as c', 'penerimaan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->where('penerimaan.counter_id', $counter_id)
                ->orderBy('penerimaan.tanggal_penerimaan', 'DESC')
                ->get();

            return view('admin.pages.penerimaan.index', compact('penerimaans'));
        }
    }
}
