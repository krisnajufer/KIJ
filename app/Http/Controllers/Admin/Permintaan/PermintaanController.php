<?php

namespace App\Http\Controllers\Admin\Permintaan;

use App\Http\Controllers\Controller;
use App\Models\Admin\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Permintaan;
use App\Models\Admin\DetailPermintaan;
use App\Models\Admin\Counter;
use Illuminate\Support\Carbon;


class PermintaanController extends Controller
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
            $permintaans = Permintaan::join('counter as c', 'permintaan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->orderBy('permintaan.tanggal_permintaan', 'DESC')
                ->get();

            return view('admin.pages.Permintaan.index', compact('permintaans'));
        } elseif ($role == 'counter') {
            $user_id = Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;
            $permintaans = Permintaan::select('permintaan.permintaan_id', 'permintaan.status', 'u.name', 'permintaan.slug', 'permintaan.tanggal_permintaan')
                ->join('counter as c', 'permintaan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->where('permintaan.counter_id', $counter_id)
                ->orderBy('permintaan.tanggal_permintaan', 'DESC')
                ->get();


            return view('admin.pages.Permintaan.index', compact('permintaans'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = Permintaan::kode();
        $barangs = Barang::select('*')->orderBy('nama_barang', 'ASC')->get();
        $temporary_permintaans = session("temporary_permintaans");
        // session()->forget("temporary_permintaans");
        return view('admin.pages.Permintaan.tambah', compact('kode', 'barangs', 'temporary_permintaans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($kode)
    {
        $user_id = Auth::guard('admin')->user()->user_id;
        $counters = Counter::where('user_id', $user_id)->first();
        $counter_id = $counters->counter_id;

        $permintaans = new Permintaan;
        $permintaans->permintaan_id = $kode;
        $permintaans->slug = \Illuminate\Support\Str::random(16);
        $permintaans->counter_id = $counter_id;
        $permintaans->tanggal_permintaan = Carbon::now();
        $permintaans->status = "Pending";
        $permintaans->save();

        $temporary_permintaans = session("temporary_permintaans");
        foreach ($temporary_permintaans as $temporary_permintaan) {

            $detail_permintaans = new DetailPermintaan;
            $detail_permintaans->permintaan_id = $kode;
            $detail_permintaans->barang_id = $temporary_permintaan['id_barang'];
            $detail_permintaans->jumlah_permintaan = $temporary_permintaan['jumlah_permintaan'];
            $detail_permintaans->save();
        }

        session()->forget("temporary_permintaans");
        return redirect()->route('permintaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $permintaans = Permintaan::where('slug', $slug)->first();

        $permintaan_id = $permintaans->permintaan_id;

        $details = DetailPermintaan::join('barang as  b', 'detail_permintaan.barang_id', '=', 'b.barang_id')
            ->where('detail_permintaan.permintaan_id', $permintaan_id)
            ->get();

        return view('admin.pages.Permintaan.detail', compact('details', 'permintaan_id'));
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

    public function temporary(Request $request)
    {
        $this->validate(
            $request,
            [
                'id_permintaan' => 'required',
                'id_barang' => 'required',
                'jumlah_permintaan' => 'required'
            ]
        );

        if ($request->id_barang != "pilih") {
            $barangs = Barang::where('barang_id', $request->id_barang)->first();

            $id_permintaan = $request->id_permintaan;
            $kode_session = $id_permintaan . $barangs->barang_id;
            // var_dump($kode_session);

            $temporary_permintaans = session("temporary_permintaans");

            $temporary_permintaans[$kode_session] = [
                "id_permintaan" => $id_permintaan,
                "id_barang" => $barangs->barang_id,
                "nama_barang" => $barangs->nama_barang,
                "jumlah_permintaan" => $request->jumlah_permintaan
            ];

            session(["temporary_permintaans" => $temporary_permintaans]);

            return redirect()->route('create.permintaan');
        } else {
            return redirect()->route('create.permintaan')->with("warning", "Mohon pilih barang sesuai nama barang dan pastikan bukan (Pilih Nama Barang)");
        }
    }

    public function destroyTemporary(Request $request)
    {
        $this->validate(
            $request,
            [
                "kode_session" => "required"
            ]
        );
        $kode_session = $request->kode_session;
        $temporary_permintaans = session("temporary_permintaans");
        unset($temporary_permintaans[$kode_session]);
        session(["temporary_permintaans" => $temporary_permintaans]);
        return redirect()->route('create.permintaan');
        // var_dump($request->kode_session);
    }

    public function cancelCreate()
    {
        $temporary_permintaans = session("temporary_permintaans");
        session()->forget("temporary_permintaans");
        return redirect()->route('permintaan');
    }
}
