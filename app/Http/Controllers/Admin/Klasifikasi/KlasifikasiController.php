<?php

namespace App\Http\Controllers\Admin\Klasifikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Klasifikasi;
use App\Models\Admin\DetailKlasifikasi;
use App\Models\Admin\Gudang;
use App\Models\Admin\Counter;
use App\Models\Admin\DetailTransaksiPenjualan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class KlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $gudangs = Gudang::where('user_id', $user_id)->first();
            $gudang_id = $gudangs->gudang_id;

            $klasifikasis = Klasifikasi::where('gudang_id', $gudang_id)->get();

            return view('admin.pages.klasifikasi.index', compact('klasifikasis'));
        } elseif ($role == 'counter') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;

            $klasifikasis = Klasifikasi::where('counter_id', $counter_id)->get();

            return view('admin.pages.klasifikasi.index', compact('klasifikasis'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $counts = 0;
        return view('admin.pages.klasifikasi.create', compact('counts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "aftersub" => "required",
            "date" => "required"
        ]);

        $afterSub = $request->aftersub;
        $date = $request->date;
        $role = Auth::guard('admin')->user()->role;

        if ($role == 'gudang') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $gudangs = Gudang::where('user_id', $user_id)->first();
            $gudang_id = $gudangs->gudang_id;

            $klasifikasi_counts = Klasifikasi::where(['gudang_id' => $gudang_id, 'tgl_mulai_klasifikasi' => $afterSub, 'tgl_akhir_klasifikasi' => $date])->count();
            if ($klasifikasi_counts > 0) {
                return redirect()->route('create.klasifikasi')->with("info", "Mohon maaf klasifikasi di tahun tersebut sudah ada");
            } else {
                $hasil = 0;
                $total = 0;
                $klasifikasi_counters = DetailKlasifikasi::select('barang.barang_id', DB::raw('SUM(detail_klasifikasi.permintaan_tahunan) AS qty_tahunan'), DB::raw('SUM(detail_klasifikasi.permintaan_tahunan * barang.harga_barang) AS costxpertahun'))
                    ->leftjoin('barang', 'detail_klasifikasi.barang_id', '=', 'barang.barang_id')
                    ->leftjoin('klasifikasi', 'detail_klasifikasi.klasifikasi_id', '=', 'klasifikasi.klasifikasi_id')
                    ->where(['klasifikasi.tgl_mulai_klasifikasi' => $afterSub, 'klasifikasi.tgl_akhir_klasifikasi' => $date, 'klasifikasi.gudang_id' => ""])
                    ->groupBy('barang.barang_id')
                    ->orderBy('costxpertahun', 'DESC')
                    ->get();

                foreach ($klasifikasi_counters as $klasifikasi_counter) {
                    $total += $klasifikasi_counter->costxpertahun;
                }

                $kode = Klasifikasi::kode();
                $klasifikasis = new Klasifikasi;

                $klasifikasis->klasifikasi_id = $kode;
                $klasifikasis->slug = \Illuminate\Support\Str::random(16);
                $klasifikasis->gudang_id = $gudang_id;
                $klasifikasis->counter_id = "";
                $klasifikasis->tgl_mulai_klasifikasi = $afterSub;
                $klasifikasis->tgl_akhir_klasifikasi = $date;
                $klasifikasis->total_biaya_pertahun = $total;
                $klasifikasis->save();

                foreach ($klasifikasi_counters as $key => $klasifikasi_counter) {
                    $detail_klasifikasi = new DetailKlasifikasi;

                    $detail_klasifikasi->klasifikasi_id = $kode;
                    $detail_klasifikasi->barang_id = $klasifikasi_counter->barang_id;
                    $detail_klasifikasi->permintaan_tahunan = $klasifikasi_counter->qty_tahunan;
                    $decimal = round(($klasifikasi_counter->costxpertahun / $total) * 100, 2);
                    $detail_klasifikasi->persentase_biaya = $decimal;

                    $hasil += $decimal;
                    if ($hasil <= 80.00) {
                        $detail_klasifikasi->klasifikasi = "A";
                    } elseif ($hasil <= 95.00) {
                        $detail_klasifikasi->klasifikasi = "B";
                    } else {
                        $detail_klasifikasi->klasifikasi = "C";
                    }

                    $detail_klasifikasi->save();
                }
                return redirect()->route('klasifikasi')->with("success", "Klasifikasi baru telah berhasil ditambahkan");
            }
        } elseif ($role == 'counter') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;

            $klasifikasi_counts = Klasifikasi::where(['counter_id' => $counter_id, 'tgl_mulai_klasifikasi' => $afterSub, 'tgl_akhir_klasifikasi' => $date])->count();

            if ($klasifikasi_counts > 0) {
                return redirect()->route('create.klasifikasi')->with("info", "Mohon maaf klasifikasi di periode tersebut sudah ada");
            } else {
                $hasil = 0;
                $total = 0;
                $klasifikasi_counters = DetailTransaksiPenjualan::select('b.barang_id', DB::raw('SUM(detail_transaksi_penjualan.qty_penjualan) AS qty_tahunan'), DB::raw('SUM(detail_transaksi_penjualan.qty_penjualan * b.harga_barang) AS costxpertahun'))
                    ->leftjoin('barang_counter as bc', 'detail_transaksi_penjualan.barang_counter_id', '=', 'bc.barang_counter_id')
                    ->leftjoin('barang as b', 'bc.barang_id', '=', 'b.barang_id')
                    ->leftjoin('transaksi_penjualan as tp', 'detail_transaksi_penjualan.transaksi_penjualan_id', '=', 'tp.transaksi_penjualan_id')
                    ->whereBetween('tp.tanggal_penjualan', [$afterSub, $date])
                    ->where('tp.counter_id', $counter_id)
                    ->groupBy('b.barang_id')
                    ->orderBy('costxpertahun', 'DESC')
                    ->get();

                foreach ($klasifikasi_counters as $klasifikasi_counter) {
                    $total += $klasifikasi_counter->costxpertahun;
                }

                $kode = Klasifikasi::kode();
                $klasifikasis = new Klasifikasi;

                $klasifikasis->klasifikasi_id = $kode;
                $klasifikasis->slug = \Illuminate\Support\Str::random(16);
                $klasifikasis->gudang_id = "";
                $klasifikasis->counter_id = $counter_id;
                $klasifikasis->tgl_mulai_klasifikasi = $afterSub;
                $klasifikasis->tgl_akhir_klasifikasi = $date;
                $klasifikasis->total_biaya_pertahun = $total;
                $klasifikasis->save();

                foreach ($klasifikasi_counters as $key => $klasifikasi_counter) {
                    $detail_klasifikasi = new DetailKlasifikasi;

                    $detail_klasifikasi->klasifikasi_id = $kode;
                    $detail_klasifikasi->barang_id = $klasifikasi_counter->barang_id;
                    $detail_klasifikasi->permintaan_tahunan = $klasifikasi_counter->qty_tahunan;
                    $decimal = round(($klasifikasi_counter->costxpertahun / $total) * 100, 2);
                    $detail_klasifikasi->persentase_biaya = $decimal;

                    $hasil += $decimal;
                    if ($hasil <= 75.00) {
                        $detail_klasifikasi->klasifikasi = "A";
                    } elseif ($hasil <= 95.00) {
                        $detail_klasifikasi->klasifikasi = "B";
                    } else {
                        $detail_klasifikasi->klasifikasi = "C";
                    }

                    $detail_klasifikasi->save();
                }
                return redirect()->route('klasifikasi')->with("success", "Klasifikasi baru telah berhasil ditambahkan");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang') {
            $klasifikasis = Klasifikasi::where('slug', $slug)->first();
            $klasifikasi_id = $klasifikasis->klasifikasi_id;
            $details = DetailKlasifikasi::select('detail_klasifikasi.klasifikasi_id', 'b.nama_barang', 'detail_klasifikasi.permintaan_tahunan', DB::raw('(detail_klasifikasi.permintaan_tahunan * b.harga_barang) as costxpertahun'), 'detail_klasifikasi.persentase_biaya', 'detail_klasifikasi.klasifikasi')
                ->join('barang as b', 'detail_klasifikasi.barang_id', '=', 'b.barang_id')
                ->where('detail_klasifikasi.klasifikasi_id', $klasifikasi_id)
                ->get();

            return view('admin.pages.klasifikasi.detail', compact('klasifikasi_id', 'details'));
        } elseif ($role == 'counter') {
            $klasifikasis = Klasifikasi::where('slug', $slug)->first();
            $klasifikasi_id = $klasifikasis->klasifikasi_id;
            $details = DetailKlasifikasi::select('detail_klasifikasi.klasifikasi_id', 'b.nama_barang', 'detail_klasifikasi.permintaan_tahunan', DB::raw('(detail_klasifikasi.permintaan_tahunan * b.harga_barang) as costxpertahun'), 'detail_klasifikasi.persentase_biaya', 'detail_klasifikasi.klasifikasi')
                ->join('barang as b', 'detail_klasifikasi.barang_id', '=', 'b.barang_id')
                ->where('detail_klasifikasi.klasifikasi_id', $klasifikasi_id)
                ->get();

            return view('admin.pages.klasifikasi.detail', compact('klasifikasi_id', 'details'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createSampleKlasifikasi(Request $request)
    {
        $this->validate($request, [
            "thn_klasifikasi" => "required",
        ]);

        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $gudangs = Gudang::where('user_id', $user_id)->first();
            $gudang_id = $gudangs->gudang_id;

            $tahun = $request->thn_klasifikasi;
            $date = Carbon::now()->format($tahun . '-28');
            $Date = Carbon::createFromFormat('Y-m-d', $date);
            $dateSub = 364;
            $afterSub = $Date->subDays($dateSub)->format('Y-m-d');

            $counter_counts = Klasifikasi::where(['klasifikasi.tgl_mulai_klasifikasi' => $afterSub, 'klasifikasi.tgl_akhir_klasifikasi' => $date])
                ->where('counter_id', '!=', '')
                ->count();

            if ($counter_counts == 4) {
                $samples = DetailKlasifikasi::select('barang.nama_barang', DB::raw('SUM(detail_klasifikasi.permintaan_tahunan) AS qty_tahunan'), DB::raw('SUM(detail_klasifikasi.permintaan_tahunan * barang.harga_barang) AS costxpertahun'))
                    ->leftjoin('barang', 'detail_klasifikasi.barang_id', '=', 'barang.barang_id')
                    ->leftjoin('klasifikasi', 'detail_klasifikasi.klasifikasi_id', '=', 'klasifikasi.klasifikasi_id')
                    ->where(['klasifikasi.tgl_mulai_klasifikasi' => $afterSub, 'klasifikasi.tgl_akhir_klasifikasi' => $date, 'klasifikasi.gudang_id' => ""])
                    ->groupBy('barang.nama_barang')
                    ->orderBy('costxpertahun', 'DESC')
                    ->get();

                $counts = DetailKlasifikasi::select('barang.nama_barang', DB::raw('SUM(detail_klasifikasi.permintaan_tahunan) AS qty_tahunan'), DB::raw('SUM(detail_klasifikasi.permintaan_tahunan * barang.harga_barang) AS costxpertahun'))
                    ->leftjoin('barang', 'detail_klasifikasi.barang_id', '=', 'barang.barang_id')
                    ->leftjoin('klasifikasi', 'detail_klasifikasi.klasifikasi_id', '=', 'klasifikasi.klasifikasi_id')
                    ->where(['klasifikasi.tgl_mulai_klasifikasi' => $afterSub, 'klasifikasi.tgl_akhir_klasifikasi' => $date, 'klasifikasi.gudang_id' => ""])
                    ->groupBy('barang.nama_barang')
                    ->count();


                return view('admin.pages.klasifikasi.create', compact('date', 'dateSub', 'afterSub', 'samples', 'tahun', 'counts'));
            } else {
                return redirect()->route('create.klasifikasi')->with("info", "Mohon maaf beberapa counter belum melakukan klasifikasi untuk tahun tersebut");
            }
        } elseif ($role == 'counter') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;

            $tahun = $request->thn_klasifikasi;
            $date = Carbon::now()->format($tahun . '-28');
            $Date = Carbon::createFromFormat('Y-m-d', $date);
            $dateSub = 364;
            $afterSub = $Date->subDays($dateSub)->format('Y-m-d');

            $samples = DetailTransaksiPenjualan::select('b.nama_barang', DB::raw('SUM(detail_transaksi_penjualan.qty_penjualan) AS qty_tahunan'), DB::raw('SUM(detail_transaksi_penjualan.qty_penjualan * b.harga_barang) AS costxpertahun'))
                ->leftjoin('barang_counter as bc', 'detail_transaksi_penjualan.barang_counter_id', '=', 'bc.barang_counter_id')
                ->leftjoin('barang as b', 'bc.barang_id', '=', 'b.barang_id')
                ->leftjoin('transaksi_penjualan as tp', 'detail_transaksi_penjualan.transaksi_penjualan_id', '=', 'tp.transaksi_penjualan_id')
                ->whereBetween('tp.tanggal_penjualan', [$afterSub, $date])
                ->where('tp.counter_id', $counter_id)
                ->groupBy('b.nama_barang')
                ->orderBy('costxpertahun', 'DESC')
                ->get();

            $counts = DetailTransaksiPenjualan::select('b.nama_barang', DB::raw('SUM(detail_transaksi_penjualan.qty_penjualan) AS qty_tahunan'), DB::raw('SUM(detail_transaksi_penjualan.qty_penjualan * b.harga_barang) AS costxpertahun'))
                ->leftjoin('barang_counter as bc', 'detail_transaksi_penjualan.barang_counter_id', '=', 'bc.barang_counter_id')
                ->leftjoin('barang as b', 'bc.barang_id', '=', 'b.barang_id')
                ->leftjoin('transaksi_penjualan as tp', 'detail_transaksi_penjualan.transaksi_penjualan_id', '=', 'tp.transaksi_penjualan_id')
                ->whereBetween('tp.tanggal_penjualan', [$afterSub, $date])
                ->where('tp.counter_id', $counter_id)
                ->groupBy('b.nama_barang')
                ->count();
            if ($counts > 0) {
                return view('admin.pages.klasifikasi.create', compact('date', 'dateSub', 'afterSub', 'samples', 'tahun', 'counts'));
            } else {
                return redirect()->route('create.klasifikasi')->with("info", "Mohon maaf belum ada transaksi untuk jarak tahun tersebut");
            }
        }
    }
}
