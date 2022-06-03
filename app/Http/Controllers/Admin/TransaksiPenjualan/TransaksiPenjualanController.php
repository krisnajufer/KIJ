<?php

namespace App\Http\Controllers\Admin\TransaksiPenjualan;

use App\Http\Controllers\Controller;
use App\Models\Admin\BarangCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Counter;
use App\Models\Admin\TransaksiPenjualan;
use App\Models\Admin\DetailTransaksiPenjualan;
use Illuminate\Support\Carbon;

class TransaksiPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id =  Auth::guard('admin')->user()->user_id;
        $counters = Counter::where('user_id', $user_id)->first();
        $counter_id = $counters->counter_id;
        $counter_name = Auth::guard('admin')->user()->name;
        $temporary_barang_counters = session("temporary_barang_counters");
        $temporary_keranjang_counters = session("temporary_keranjang_counters");
        $kode = TransaksiPenjualan::kode();

        if (!empty($temporary_barang_counters)) {
            return view('admin.pages.kasir.index', compact('counter_name', 'temporary_barang_counters', 'kode', 'temporary_keranjang_counters'));
        } else {
            $barang_counters = BarangCounter::select('barang_counter.barang_counter_id', 'barang_counter.slug', 'b.nama_barang', 'b.harga_barang', 'barang_counter.barang_counter_stok')
                ->join('barang as b', 'barang_counter.barang_id', '=', 'b.barang_id')
                ->where('barang_counter.counter_id', $counter_id)
                ->orderBy('barang_counter.barang_counter_id', 'DESC')
                ->get();

            foreach ($barang_counters as $barang_counter) {
                $temporary_barang_counters = session("temporary_barang_counters");
                $kode_session = $barang_counter->barang_counter_id;
                $temporary_barang_counters[$kode_session] = [
                    "barang_counter_id" => $barang_counter->barang_counter_id,
                    "slug" => $barang_counter->slug,
                    "nama_barang" => $barang_counter->nama_barang,
                    "barang_counter_stok" => $barang_counter->barang_counter_stok,
                    "harga_barang" => $barang_counter->harga_barang,
                ];

                session(["temporary_barang_counters" => $temporary_barang_counters]);
            }
            return view('admin.pages.kasir.index', compact('counter_name', 'temporary_barang_counters', 'kode'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $user_id =  Auth::guard('admin')->user()->user_id;
        $counters = Counter::where('user_id', $user_id)->first();
        $counter_id = $counters->counter_id;
        $counter_name = Auth::guard('admin')->user()->name;
        $kode = TransaksiPenjualan::kode();
        $transaksi_penjualans = new TransaksiPenjualan;


        $temporary_barang_counters = session("temporary_barang_counters");
        $temporary_keranjang_counters = session("temporary_keranjang_counters");
        $grand_total = 0;

        foreach ($temporary_keranjang_counters as $temporary_keranjang_counter) {
            $grand_total = $grand_total + $temporary_keranjang_counter['harga_barang'] * $temporary_keranjang_counter['barang_counter_stok'];
        }

        $transaksi_penjualans->transaksi_penjualan_id = $kode;
        $transaksi_penjualans->slug = \Illuminate\Support\Str::random(16);
        $transaksi_penjualans->counter_id = $counter_id;
        $transaksi_penjualans->tanggal_penjualan = Carbon::now();
        $transaksi_penjualans->grand_total_penjualan = $grand_total;

        $transaksi_penjualans->save();

        foreach ($temporary_keranjang_counters as $temporary_keranjang_counter) {
            $detail_transaksi_penjualans = new DetailTransaksiPenjualan;
            $detail_transaksi_penjualans->transaksi_penjualan_id = $kode;
            $detail_transaksi_penjualans->barang_counter_id = $temporary_keranjang_counter['barang_counter_id'];
            $detail_transaksi_penjualans->qty_penjualan = $temporary_keranjang_counter['barang_counter_stok'];
            $detail_transaksi_penjualans->subtotal_penjualan = $temporary_keranjang_counter['barang_counter_stok'] * $temporary_keranjang_counter['harga_barang'];

            $detail_transaksi_penjualans->save();

            $barang_counters = BarangCounter::where('barang_counter_id',  $temporary_keranjang_counter['barang_counter_id'])->first();
            $barang_counters->barang_counter_stok = $barang_counters->barang_counter_stok - $temporary_keranjang_counter['barang_counter_stok'];

            $barang_counters->save();
        }

        session()->forget("temporary_barang_counters");
        session()->forget("temporary_keranjang_counters");

        return redirect()->route('kasir');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $transaksi_penjualans = TransaksiPenjualan::where('slug', $slug)->first();
        $transaksi_penjualan_id = $transaksi_penjualans->transaksi_penjualan_id;
        $details = DetailTransaksiPenjualan::join('barang_counter as bc', 'detail_transaksi_penjualan.barang_counter_id', '=', 'bc.barang_counter_id')
            ->join('barang as b', 'bc.barang_id', '=', 'b.barang_id')
            ->where('detail_transaksi_penjualan.transaksi_penjualan_id', $transaksi_penjualan_id)->get();

        return view('admin.pages.transaksi.detail', compact('transaksi_penjualan_id', 'details'));
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

    public function addTemporaryKeranjang(Request $request)
    {
        $this->validate($request, [
            'qty_penjualan' => 'required',
            'slug' => 'required'
        ]);

        $barang_counters = BarangCounter::select('barang_counter.barang_counter_id', 'barang_counter.slug', 'b.nama_barang', 'b.harga_barang', 'barang_counter.barang_counter_stok')
            ->join('barang as b', 'barang_counter.barang_id', '=', 'b.barang_id')
            ->where('barang_counter.slug', $request->slug)
            ->first();
        $barang_counter_id = $barang_counters->barang_counter_id;

        if ($barang_counters->barang_counter_stok < $request->qty_penjualan) {
            $temporary_keranjang_counters = session("temporary_keranjang_counters");
            $temporary_barang_counters = session("temporary_barang_counters");
            session()->flash("warning", "Stok barang tidak mencukupi");
            return redirect()->route('kasir');
        } else {
            $temporary_keranjang_counters = session("temporary_keranjang_counters");
            if (!empty($temporary_keranjang_counters[$barang_counter_id])) {
                $stok_kembali = $temporary_keranjang_counters[$barang_counter_id]['barang_counter_stok'];
            } else {
                $stok_kembali = 0;
            }
            $temporary_barang_counters = session("temporary_barang_counters");
            $temporary_barang_counters[$barang_counter_id] = [
                "barang_counter_id" => $barang_counters->barang_counter_id,
                "slug" => $barang_counters->slug,
                "nama_barang" => $barang_counters->nama_barang,
                "barang_counter_stok" => $temporary_barang_counters[$barang_counter_id]['barang_counter_stok'] - $request->qty_penjualan + $stok_kembali,
                "harga_barang" => $barang_counters->harga_barang,
            ];

            session(["temporary_barang_counters" => $temporary_barang_counters]);

            $temporary_keranjang_counters = session("temporary_keranjang_counters");
            if (!empty($temporary_keranjang_counters[$barang_counter_id])) {
                $temporary_keranjang_counters[$barang_counter_id] = [
                    "barang_counter_id" => $barang_counters->barang_counter_id,
                    "slug" => $barang_counters->slug,
                    "nama_barang" => $barang_counters->nama_barang,
                    "barang_counter_stok" => $request->qty_penjualan,
                    "harga_barang" => $barang_counters->harga_barang,
                ];
                session(["temporary_keranjang_counters" => $temporary_keranjang_counters]);
            } else {
                $temporary_keranjang_counters[$barang_counter_id] = [
                    "barang_counter_id" => $barang_counters->barang_counter_id,
                    "slug" => $barang_counters->slug,
                    "nama_barang" => $barang_counters->nama_barang,
                    "barang_counter_stok" => $request->qty_penjualan,
                    "harga_barang" => $barang_counters->harga_barang,
                ];

                session(["temporary_keranjang_counters" => $temporary_keranjang_counters]);
            }

            return redirect()->route('kasir');
        }
    }

    public function destroyTemporaryKeranjang(Request $request)
    {
        $this->validate($request, [
            'slug_delete' => 'required'
        ]);

        $barang_counters = BarangCounter::select('barang_counter.barang_counter_id', 'barang_counter.slug', 'b.nama_barang', 'b.harga_barang', 'barang_counter.barang_counter_stok')
            ->join('barang as b', 'barang_counter.barang_id', '=', 'b.barang_id')
            ->where('barang_counter.slug', $request->slug_delete)
            ->first();

        $barang_counter_id = $barang_counters->barang_counter_id;

        $temporary_barang_counters = session("temporary_barang_counters");
        $temporary_keranjang_counters = session("temporary_keranjang_counters");
        $temporary_barang_counters[$barang_counter_id] = [
            "barang_counter_id" => $barang_counters->barang_counter_id,
            "slug" => $barang_counters->slug,
            "nama_barang" => $barang_counters->nama_barang,
            "barang_counter_stok" => $temporary_barang_counters[$barang_counter_id]['barang_counter_stok'] + $temporary_keranjang_counters[$barang_counter_id]['barang_counter_stok'],
            "harga_barang" => $barang_counters->harga_barang,
        ];
        session(["temporary_barang_counters" => $temporary_barang_counters]);

        unset($temporary_keranjang_counters[$barang_counter_id]);
        session(["temporary_keranjang_counters" => $temporary_keranjang_counters]);
        return redirect()->route('kasir');
    }

    public function indexTransaksi()
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang' or $role == 'owner') {
            $transaksi_penjualans = TransaksiPenjualan::select('transaksi_penjualan.transaksi_penjualan_id', 'transaksi_penjualan.slug', 'u.name', 'transaksi_penjualan.tanggal_penjualan', 'transaksi_penjualan.grand_total_penjualan')
                ->join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')->get();

            return view('admin.pages.transaksi.index', compact('transaksi_penjualans'));
        } elseif ($role == 'counter') {
            $user_id =  Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;
            $transaksi_penjualans = TransaksiPenjualan::select('transaksi_penjualan.transaksi_penjualan_id', 'transaksi_penjualan.slug', 'u.name', 'transaksi_penjualan.tanggal_penjualan', 'transaksi_penjualan.grand_total_penjualan')
                ->join('counter as c', 'transaksi_penjualan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->where('transaksi_penjualan.counter_id', $counter_id)->get();

            return view('admin.pages.transaksi.index', compact('transaksi_penjualans'));
        }
    }
}
