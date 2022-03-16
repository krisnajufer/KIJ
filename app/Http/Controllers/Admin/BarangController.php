<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Barang;
use App\Models\Admin\BarangCounter;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Counter;

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

            $barangs = Barang::select('*')->orderBy('barang_id', 'desc')->get();
            return view('admin.pages.barang.index', compact('barangs'));
        } elseif ($role == 'counter') {

            $user_id =  Auth::guard('admin')->user()->user_id;
            $counters = Counter::where('user_id', $user_id)->first();
            $counter_id = $counters->counter_id;

            $barangs = BarangCounter::join('barang as b', 'barang_counter.barang_id', '=', 'b.barang_id')
                ->where('barang_counter.counter_id', $counter_id)
                ->get();

            return view('admin.pages.barang.index', compact('barangs'));
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
    public function store(Request $request)
    {
        //
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
}
