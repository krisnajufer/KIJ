<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Barang;
use App\Models\Admin\BarangCounter;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Counter;
use Illuminate\Support\Facades\Redirect;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang' or $role == 'owner') {

            return view('admin.pages.barang.index');
        } elseif ($role == 'counter') {

            $user_id =  Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;

            $barangs = BarangCounter::join('barang as b', 'barang_counter.barang_id', '=', 'b.barang_id')
                ->where('barang_counter.counter_id', $counter_id)
                ->orderBy('barang_counter.barang_counter_id', 'desc')
                ->get();

            return view('admin.pages.barang.index', compact('barangs'));;
        }
    }

    public function getGudang(Request $request)
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang' or $role == 'owner') {
            $this->validate($request, [
                'sumber' => 'required'
            ]);

            $sumber = $request->sumber;
            if ($sumber == 'gudang') {
                $barangs = Barang::select('*')->orderBy('barang_id', 'desc')->get();

                return response()->json(array(
                    'barang' => $barangs,
                ), 200);
            }
        } else {
            return back();
        }
    }

    public function getCounter(Request $request)
    {
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang' or $role == 'owner') {
            $this->validate($request, [
                'sumber' => 'required'
            ]);

            $sumber = $request->sumber;
            if ($sumber == 'counter') {
                $barangs = BarangCounter::join('barang as b', 'barang_counter.barang_id', '=', 'b.barang_id')
                    ->join('counter as c', 'barang_counter.counter_id', '=', 'c.counter_id')
                    ->join('users as u', 'c.user_id', '=', 'u.user_id')
                    ->orderBy('barang_counter.barang_counter_id', 'desc')
                    ->get();

                return response()->json(array(
                    'barang' => $barangs,
                ), 200);
            }
        } else {
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = Barang::kode();

        return view('admin.pages.barang.tambah', compact('kode'));
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
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'stok_barang' => 'required'
        ]);

        $cek_barang = Barang::where('nama_barang', $request->nama_barang)->count();

        if ($cek_barang == 0) {
            $kode = Barang::kode();
            $barang = new Barang;
            $barang->barang_id = $request->id_barang;
            $barang->slug = \Illuminate\Support\Str::random(16);
            $barang->nama_barang = $request->nama_barang;
            $barang->stok_barang = $request->stok_barang;
            $barang->harga_barang = $request->harga_barang;
            $barang->save();

            return redirect()->intended('barang')->with("success", "Data barang baru berhasil ditambahkan");
        } else {
            return back()->with("warning", "Data barang sudah ada !!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $barangs = Barang::where('slug', $slug)->first();

        return view('admin.pages.barang.edit', compact('barangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $barangs = Barang::where('slug', $slug)->first();

        $barangs->nama_barang = $request->get('nama_barang');
        $barangs->stok_barang = $request->get('stok_barang');
        $barangs->harga_barang = $request->get('harga_barang');
        $barangs->save();

        return redirect('barang')->with("success", "Data barang berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        Barang::where('slug', $slug)->delete();
        session()->flash("info", "Data barang berhasil dihapus !!");
        return redirect::to('barang');
    }
}
