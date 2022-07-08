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

        $month = substr($periode, 5);
        $year = substr($periode, 0, 4);

        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang' or $role == 'owner') {
            $transaksi_penjualans = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereMonth('transaksi_penjualan.tanggal_penjualan', $month)
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $year)
                ->orderBy('transaksi_penjualan.tanggal_penjualan', 'DESC')
                ->get();

            $counts = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereMonth('transaksi_penjualan.tanggal_penjualan', $month)
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $year)
                ->count();
            $date = date_create($periode);
            $date = date_format($date, "F Y");
            if ($counts > 0) {
                return view('admin.pages.laporan.transaksi_penjualan.index', compact('transaksi_penjualans', 'counts', 'date', 'periode'));
            } else {
                return back()->with("info", "Belum ada transaksi dalam tahun tersebut");
            }
        } elseif ($role == 'counter') {
            $user_id =  Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;

            $transaksi_penjualans = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $year)
                ->whereMonth('transaksi_penjualan.tanggal_penjualan', $month)
                ->where('transaksi_penjualan.counter_id', $counter_id)
                ->orderBy('transaksi_penjualan.tanggal_penjualan', 'DESC')
                ->get();

            $counts = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $year)
                ->whereMonth('transaksi_penjualan.tanggal_penjualan', $month)
                ->where('transaksi_penjualan.counter_id', $counter_id)
                ->orderBy('transaksi_penjualan.tanggal_penjualan', 'DESC')
                ->count();

            if ($counts > 0) {
                return view('admin.pages.laporan.transaksi_penjualan.index', compact('transaksi_penjualans', 'counts', 'periode'));
            } else {
                return back()->with("info", "Belum ada transaksi dalam waktu tersebut");
            }
        }
    }

    public function exportTransaksiPenjualan(Request $request)
    {
        $this->validate($request, [
            "tahun_periode" => "required"
        ]);
        $periode = $request->tahun_periode;
        $month = substr($periode, 5);
        $year = substr($periode, 0, 4);

        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang' or $role == 'owner') {
            $transaksi_penjualans = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereMonth('transaksi_penjualan.tanggal_penjualan', $month)
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $year)
                ->orderBy('transaksi_penjualan.tanggal_penjualan', 'DESC')
                ->get();
            $date_create = date_create($periode);
            $date = date_format($date_create, "F Y");
            $pdf = PDF::loadView('admin.pages.laporan.transaksi_penjualan.export', compact('date', 'periode', 'transaksi_penjualans'));

            return $pdf->download('Laporan Penjualan ' . $date . '.pdf');
        } elseif ($role == 'counter') {
            $user_id =  Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;
            $counter_name = Auth::guard('admin')->user()->name;

            $transaksi_penjualans = TransaksiPenjualan::join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->whereMonth('transaksi_penjualan.tanggal_penjualan', $month)
                ->whereYear('transaksi_penjualan.tanggal_penjualan', $year)
                ->where('transaksi_penjualan.counter_id', $counter_id)
                ->orderBy('transaksi_penjualan.tanggal_penjualan', 'DESC')
                ->get();
            $date_create = date_create($periode);
            $date = date_format($date_create, "F Y");
            $pdf = PDF::loadView('admin.pages.laporan.transaksi_penjualan.export', compact('date', 'transaksi_penjualans', 'counter_name'));
            return $pdf->download('Laporan Penjualan ' . $counter_name . ' - Tahun ' . $date . '.pdf');
        }
    }
}
