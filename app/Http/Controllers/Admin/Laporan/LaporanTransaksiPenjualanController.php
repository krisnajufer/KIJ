<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Counter;
use App\Models\Admin\TransaksiPenjualan;
use PDF;

class LaporanTransaksiPenjualanController extends Controller
{
    public function index()
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang' or $role == 'owner') {
            $counts = 0;

            return view('admin.pages.laporan.transaksi_penjualan.index', compact('counts'));
        } elseif ($role == 'counter') {
            $counts = 0;

            return view('admin.pages.laporan.transaksi_penjualan.index', compact('counts'));
        }
    }

    public function getindexPeriode(Request $request)
    {
        $this->validate($request, [
            "periode" => "required"
        ]);

        $periode = $request->periode;

        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang' or $role == 'owner') {
            $transaksi_penjualans = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $periode)
                ->orderBy('transaksi_penjualan.tanggal_penjualan', 'DESC')
                ->get();

            $counts = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $periode)
                ->count();

            if ($counts > 0) {
                return view('admin.pages.laporan.transaksi_penjualan.index', compact('transaksi_penjualans', 'counts', 'periode'));
            } else {
                return back()->with("info", "Belum ada transaksi dalam tahun tersebut");
            }
        } elseif ($role == 'counter') {
            $user_id =  Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;

            $transaksi_penjualans = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $periode)
                ->where('transaksi_penjualan.counter_id', $counter_id)
                ->orderBy('transaksi_penjualan.tanggal_penjualan', 'DESC')
                ->get();

            $counts = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $periode)
                ->where('transaksi_penjualan.counter_id', $counter_id)
                ->orderBy('transaksi_penjualan.tanggal_penjualan', 'DESC')
                ->count();

            if ($counts > 0) {
                return view('admin.pages.laporan.transaksi_penjualan.index', compact('transaksi_penjualans', 'counts', 'periode'));
            } else {
                return back()->with("info", "Belum ada transaksi dalam tahun tersebut");
            }
        }
    }

    public function exportTransaksiPenjualan(Request $request)
    {
        $this->validate($request, [
            "tahun_periode" => "required"
        ]);
        $periode = $request->tahun_periode;

        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang' or $role == 'owner') {
            $transaksi_penjualans = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $periode)
                ->orderBy('transaksi_penjualan.tanggal_penjualan', 'DESC')
                ->get();

            $pdf = PDF::loadView('admin.pages.laporan.transaksi_penjualan.export', compact('periode', 'transaksi_penjualans'));

            return $pdf->download('Laporan Penjualan ' . $periode . '.pdf');
        } elseif ($role == 'counter') {
            $user_id =  Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;
            $counter_name = Auth::guard('admin')->user()->name;

            $transaksi_penjualans = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $periode)
                ->where('transaksi_penjualan.counter_id', $counter_id)
                ->orderBy('transaksi_penjualan.tanggal_penjualan', 'DESC')
                ->get();

            $pdf = PDF::loadView('admin.pages.laporan.transaksi_penjualan.export', compact('periode', 'transaksi_penjualans', 'counter_name'));

            return $pdf->download('Laporan Penjualan ' . $counter_name . ' - Tahun ' . $periode . '.pdf');
        }
    }
}
