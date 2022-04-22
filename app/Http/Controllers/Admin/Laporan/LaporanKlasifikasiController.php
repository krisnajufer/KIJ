<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Klasifikasi;
use App\Models\Admin\Counter;
use App\Models\Admin\Gudang;
use App\Models\Admin\DetailKlasifikasi;
use PDF;

class LaporanKlasifikasiController extends Controller
{
    public function index()
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang' or $role == 'owner') {
            return view('admin.pages.laporan.klasifikasi.index');
        } elseif ($role == 'counter') {
            $user_id =  Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;

            $klasifikasis = Klasifikasi::select('klasifikasi.klasifikasi_id', 'klasifikasi.slug', 'u.name', 'klasifikasi.tgl_mulai_klasifikasi', 'klasifikasi.tgl_akhir_klasifikasi', 'klasifikasi.total_biaya_pertahun')
                ->join('counter as c', 'klasifikasi.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->where('klasifikasi.counter_id', $counter_id)
                ->orderBy('klasifikasi.klasifikasi_id', 'DESC')
                ->get();

            return view('admin.pages.laporan.klasifikasi.index', compact('klasifikasis'));
        }
    }

    public function getKlasifikasiGudang(Request $request)
    {
        $this->validate($request, [
            "sumber" => "required"
        ]);

        $sumber = $request->sumber;
        $role = Auth::guard('admin')->user()->role;

        if ($role == 'gudang' or $role == 'owner') {
            $klasifikasis = Klasifikasi::select('klasifikasi.klasifikasi_id', 'klasifikasi.slug', 'u.name', 'klasifikasi.tgl_mulai_klasifikasi', 'klasifikasi.tgl_akhir_klasifikasi', 'klasifikasi.total_biaya_pertahun')
                ->join('gudang as g', 'klasifikasi.gudang_id', '=', 'g.gudang_id')
                ->join('users as u', 'g.user_id', '=', 'u.user_id')
                ->where('klasifikasi.gudang_id', 'G0001')
                ->orderBy('klasifikasi.klasifikasi_id', 'DESC')
                ->get();

            return response()->json(array(
                'klasifikasi' => $klasifikasis,
            ), 200);
        } else {
            return back();
        }
    }

    public function getKlasifikasiCounter(Request $request)
    {
        $this->validate($request, [
            "sumber" => "required"
        ]);

        $sumber = $request->sumber;
        $role = Auth::guard('admin')->user()->role;

        if ($role == 'gudang' or $role == 'owner') {
            $klasifikasis = Klasifikasi::select('klasifikasi.klasifikasi_id', 'klasifikasi.slug', 'u.name', 'klasifikasi.tgl_mulai_klasifikasi', 'klasifikasi.tgl_akhir_klasifikasi', 'klasifikasi.total_biaya_pertahun')
                ->join('counter as c', 'klasifikasi.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->where('klasifikasi.gudang_id', '')
                ->orderBy('klasifikasi.klasifikasi_id', 'DESC')
                ->get();

            return response()->json(array(
                'klasifikasi' => $klasifikasis,
            ), 200);
        } else {
            return back();
        }
    }

    public function show($slug)
    {
        $klasifikasis = Klasifikasi::where('slug', $slug)->first();
        $klasifikasi_id = $klasifikasis->klasifikasi_id;
        $start_date = $klasifikasis->tgl_mulai_klasifikasi;
        $end_date = $klasifikasis->tgl_akhir_klasifikasi;

        $details = DetailKlasifikasi::join('barang as b', 'detail_klasifikasi.barang_id', '=', 'b.barang_id')
            ->where('detail_klasifikasi.klasifikasi_id', $klasifikasi_id)
            ->get();

        return view('admin.pages.laporan.klasifikasi.detail', compact('details', 'klasifikasi_id', 'start_date', 'end_date', 'slug'));
    }

    public function exportKlasifikasi(Request $request)
    {
        $this->validate($request, [
            "slug" => "required"
        ]);

        $slug = $request->slug;
        $klasifikasis = Klasifikasi::where('slug', $slug)->first();
        $klasifikasi_id = $klasifikasis->klasifikasi_id;
        $start_date = substr($klasifikasis->tgl_mulai_klasifikasi, 0, 4);
        $end_date = substr($klasifikasis->tgl_akhir_klasifikasi, 0, 4);


        $details = DetailKlasifikasi::join('barang as b', 'detail_klasifikasi.barang_id', '=', 'b.barang_id')
            ->where('detail_klasifikasi.klasifikasi_id', $klasifikasi_id)
            ->get();

        $pdf = PDF::loadView('admin.pages.laporan.klasifikasi.export', compact('details', 'klasifikasi_id', 'start_date', 'end_date', 'slug'));

        return $pdf->download('Laporan Klasifikasi Tahun ' . $start_date . ' - ' . $end_date . '.pdf');
    }
}
