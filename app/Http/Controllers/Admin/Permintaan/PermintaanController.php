<?php

namespace App\Http\Controllers\Admin\Permintaan;

use App\Http\Controllers\Controller;
use App\Models\Admin\Barang;
use App\Models\Admin\BarangCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Permintaan;
use App\Models\Admin\DetailPermintaan;
use App\Models\Admin\Counter;
use Illuminate\Support\Carbon;
use App\Models\Admin\Pengiriman;
use App\Models\Admin\DetailPengiriman;
use App\Models\Admin\Gudang;
use Illuminate\Support\Facades\DB;


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
            $permintaans = Permintaan::select('permintaan.permintaan_id', 'permintaan.status', 'u.name', 'permintaan.slug', 'permintaan.tanggal_permintaan')
                ->join('counter as c', 'permintaan.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->orderBy('permintaan.tanggal_permintaan', 'DESC')
                ->orderBy('permintaan.permintaan_id', 'DESC')
                ->orderBy(DB::raw('FIELD(status, "Pending", "Proses", "Dikirim", "Diterima")'))
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
                ->orderBy('permintaan.permintaan_id', 'DESC')
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
        $role = Auth::guard('admin')->user()->role;
        if ($role == 'gudang') {
            $permintaans = Permintaan::where('slug', $slug)->first();
            if ($permintaans->status == 'Pending') {
                $permintaans->status = "Proses";
                $permintaans->save();
            }
            $permintaan_id = $permintaans->permintaan_id;
            $details = DetailPermintaan::join('barang as  b', 'detail_permintaan.barang_id', '=', 'b.barang_id')
                ->join('permintaan as p', 'detail_permintaan.permintaan_id', '=', 'p.permintaan_id')
                ->where('detail_permintaan.permintaan_id', $permintaan_id)
                ->get();

            $count_persetujuans = DetailPermintaan::join('barang as  b', 'detail_permintaan.barang_id', '=', 'b.barang_id')
                ->where('detail_permintaan.permintaan_id', $permintaan_id)
                ->count();

            $temporary_persetujuans = session("temporary_persetujuans");
            $tmp = (array) $temporary_persetujuans;
            $count_tmp = count($tmp);

            return view('admin.pages.Permintaan.detail', compact('details', 'permintaan_id', 'count_tmp', 'count_persetujuans', 'slug', 'temporary_persetujuans'));
        } elseif ($role == 'counter') {
            $permintaans = Permintaan::where('slug', $slug)->first();

            $permintaan_id = $permintaans->permintaan_id;

            $details = DetailPermintaan::join('barang as  b', 'detail_permintaan.barang_id', '=', 'b.barang_id')
                ->join('permintaan as p', 'detail_permintaan.permintaan_id', '=', 'p.permintaan_id')
                ->where('detail_permintaan.permintaan_id', $permintaan_id)
                ->get();

            return view('admin.pages.Permintaan.detail', compact('details', 'permintaan_id'));
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

    public function createPersetujuan($slug, $id_barang)
    {
        $permintaans = Permintaan::where('slug', $slug)->first();
        $permintaan_id = $permintaans->permintaan_id;
        $counter_id = $permintaans->counter_id;
        $kode = Pengiriman::kode($permintaan_id);

        $details = DetailPermintaan::select('p.permintaan_id', 'p.slug', 'u.name', 'b.barang_id', 'b.nama_barang', 'detail_permintaan.jumlah_permintaan')
            ->join('permintaan as p', 'detail_permintaan.permintaan_id', '=', 'p.permintaan_id')
            ->join('barang as b', 'detail_permintaan.barang_id', '=', 'b.barang_id')
            ->join('counter as c', 'p.counter_id', '=', 'c.counter_id')
            ->join('users as u', 'c.user_id', '=', 'u.user_id')
            ->where(['detail_permintaan.permintaan_id' => $permintaan_id, 'detail_permintaan.barang_id' => $id_barang])
            ->first();

        $sisa_barang = BarangCounter::join('barang as b', 'barang_counter.barang_id', '=', 'b.barang_id')
            ->join('counter as c', 'barang_counter.counter_id', '=', 'c.counter_id')
            ->where(['barang_counter.barang_id' => $id_barang, 'barang_counter.counter_id' => $counter_id])
            ->first();

        if (!empty($sisa_barang)) {
            $sisa = $sisa_barang->barang_counter_stok;
        } else {
            $sisa = 0;
        }
        var_dump($sisa);
        return view('admin.pages.Permintaan.persetujuan', compact('permintaan_id', 'counter_id', 'kode', 'details', 'slug', 'sisa'));
    }

    public function getGudangorCounter(Request $request)
    {
        $sumber = $request->sumber;
        if ($sumber == 'gudang') {
            $gudangs = Gudang::join('users as u', 'gudang.user_id', '=', 'u.user_id')
                ->get();
            return response()->json(array(
                'msg' => $gudangs
            ), 200);
        } elseif ($sumber == 'counter') {
            $permintaan_id = $request->id_permintaan;
            $barang_id = $request->id_barang;

            $permintaans = Permintaan::where('permintaan_id', $permintaan_id)->first();
            $counter_id = $permintaans->counter_id;
            $counters = BarangCounter::join('counter as c', 'barang_counter.counter_id', '=', 'c.counter_id')
                ->join('users as u', 'c.user_id', '=', 'u.user_id')
                ->where('barang_counter.counter_id', '<>', $counter_id)
                ->where('barang_counter.barang_id', '=', $barang_id)
                ->where('barang_counter.barang_counter_stok', '>=', '10')
                ->get();

            return response()->json(array(
                'msg' => $counters
            ), 200);
        }
    }

    public function temporaryPersetujuan(Request $request)
    {
        $persetujuan = $request->persetujuan;
        if ($persetujuan == 'Setuju') {
            $permintaan_id = $request->id_permintaan;
            $pengiriman_id = $request->id_pengiriman;
            $barang_id = $request->id_barang;
            $kode_session = $permintaan_id . $barang_id;
            $jumlah_pengiriman = $request->jumlah_pengiriman;
            $sumber = $request->sumber;
            $id_sumber = $request->id_sumber;
            $slug = $request->slug;
            $alasan = "-";


            if ($sumber == 'counter') {
                $cek_barang_counter = BarangCounter::where(['barang_id' => $barang_id, 'counter_id' => $id_sumber])->count();
                if ($cek_barang_counter > 0) {
                    // return redirect('/permintaan/create/persetujuan/' . $slug . '/' . $barang_id)->with("warning", "");
                    $barang_counters = BarangCounter::where(['barang_id' => $barang_id, 'counter_id' => $id_sumber])->first();
                    $cek_stok_bc = $barang_counters->barang_counter_stok;
                    if ($cek_stok_bc > $jumlah_pengiriman) {
                        $temporary_persetujuans = session("temporary_persetujuans");

                        $temporary_persetujuans[$kode_session] = [
                            "pengiriman_id" => $pengiriman_id,
                            "barang_id" => $barang_id,
                            "jumlah_pengiriman" => $jumlah_pengiriman,
                            "sumber" => $sumber,
                            "id_sumber" => $id_sumber,
                            "persetujuan" => $persetujuan,
                            "alasan" => $alasan,
                        ];

                        session(["temporary_persetujuans" => $temporary_persetujuans]);

                        $permintaans = Permintaan::where('permintaan_id', $permintaan_id)->first();
                        $slug = $permintaans->slug;

                        return redirect('/permintaan/show/' . $slug);
                    } else {
                        return redirect('/permintaan/create/persetujuan/' . $slug . '/' . $barang_id)->with("warning", "stok barang tidak mencukupi dicounter yang dipilih");
                    }
                } else {
                    return redirect('/permintaan/create/persetujuan/' . $slug . '/' . $barang_id)->with("warning", "barang tidak ada dicounter yang dipilih");
                }
            } elseif ($sumber == 'gudang') {
                $barangs = Barang::where('barang_id', $barang_id)->first();
                $stok_barang = $barangs->stok_barang;
                if ($stok_barang > $jumlah_pengiriman) {
                    $temporary_persetujuans = session("temporary_persetujuans");

                    $temporary_persetujuans[$kode_session] = [
                        "pengiriman_id" => $pengiriman_id,
                        "barang_id" => $barang_id,
                        "jumlah_pengiriman" => $jumlah_pengiriman,
                        "sumber" => $sumber,
                        "id_sumber" => $id_sumber,
                        "persetujuan" => $persetujuan,
                        "alasan" => $alasan,
                    ];

                    session(["temporary_persetujuans" => $temporary_persetujuans]);

                    $permintaans = Permintaan::where('permintaan_id', $permintaan_id)->first();
                    $slug = $permintaans->slug;

                    return redirect('/permintaan/show/' . $slug);
                } else {
                    return redirect('/permintaan/create/persetujuan/' . $slug . '/' . $barang_id)->with("warning", "stok barang tidak mencukupi digudang yang dipilih");
                }
            }
        } elseif ($persetujuan == 'Tidak') {
            $permintaan_id = $request->id_permintaan;
            $pengiriman_id = $request->id_pengiriman;
            $barang_id = $request->id_barang;
            $kode_session = $permintaan_id . $barang_id;
            $jumlah_pengiriman = $request->jumlah_pengiriman;
            $sumber = "";
            $id_sumber = "";
            $alasan = $request->alasan;

            $temporary_persetujuans = session("temporary_persetujuans");

            $temporary_persetujuans[$kode_session] = [
                "pengiriman_id" => $pengiriman_id,
                "barang_id" => $barang_id,
                "jumlah_pengiriman" => $jumlah_pengiriman,
                "sumber" => $sumber,
                "id_sumber" => $id_sumber,
                "persetujuan" => $persetujuan,
                "alasan" => $alasan
            ];

            session(["temporary_persetujuans" => $temporary_persetujuans]);
            $permintaans = Permintaan::where('permintaan_id', $permintaan_id)->first();
            $slug = $permintaans->slug;

            return redirect('/permintaan/show/' . $slug);
        }
    }

    public function storePengiriman($permintaan_id)
    {
        $temporary_persetujuans = session("temporary_persetujuans");
        $pengiriman_id = Pengiriman::kode($permintaan_id);
        $pengirimans = new Pengiriman;
        $ditolak_counts  = 0;

        foreach ($temporary_persetujuans as $temporary_persetujuan) {
            if ($temporary_persetujuan['persetujuan'] == 'Setuju') {
                $ditolak_counts++;
            }
        }

        if ($ditolak_counts > 0) {
            $pengirimans->pengiriman_id = $pengiriman_id;
            $pengirimans->slug = \Illuminate\Support\Str::random(16);
            $pengirimans->permintaan_id = $permintaan_id;
            $pengirimans->tanggal_pengiriman = Carbon::now();
            $pengirimans->save();

            $permintaans = Permintaan::where('permintaan_id', $permintaan_id)->first();
            $permintaans->status = "Dikirim";
            $permintaans->save();


            foreach ($temporary_persetujuans as $temporary_persetujuan) {

                if ($temporary_persetujuan['sumber'] == 'gudang') {
                    $detail_pengirimans = new DetailPengiriman;
                    $detail_pengirimans->pengiriman_id = $temporary_persetujuan['pengiriman_id'];
                    $detail_pengirimans->barang_id = $temporary_persetujuan['barang_id'];
                    $detail_pengirimans->jumlah_pengiriman = $temporary_persetujuan['jumlah_pengiriman'];
                    $detail_pengirimans->sumber = $temporary_persetujuan['sumber'];
                    $detail_pengirimans->persetujuan = $temporary_persetujuan['persetujuan'];
                    $detail_pengirimans->gudang_id = $temporary_persetujuan['id_sumber'];
                    $detail_pengirimans->alasan = $temporary_persetujuan['alasan'];
                    $detail_pengirimans->save();
                } else {
                    $detail_pengirimans = new DetailPengiriman;
                    $detail_pengirimans->pengiriman_id = $temporary_persetujuan['pengiriman_id'];
                    $detail_pengirimans->barang_id = $temporary_persetujuan['barang_id'];
                    $detail_pengirimans->jumlah_pengiriman = $temporary_persetujuan['jumlah_pengiriman'];
                    $detail_pengirimans->sumber = $temporary_persetujuan['sumber'];
                    $detail_pengirimans->persetujuan = $temporary_persetujuan['persetujuan'];
                    $detail_pengirimans->counter_id = $temporary_persetujuan['id_sumber'];
                    $detail_pengirimans->alasan = $temporary_persetujuan['alasan'];
                    $detail_pengirimans->save();
                }
            }
            session()->forget("temporary_persetujuans");
            return redirect()->route('permintaan');
        } else {
            $permintaans = Permintaan::where('permintaan_id', $permintaan_id)->first();
            $permintaans->status = "Ditolak";
            $permintaans->save();

            session()->forget("temporary_persetujuans");
            return redirect()->route('permintaan');
        }
    }
}
