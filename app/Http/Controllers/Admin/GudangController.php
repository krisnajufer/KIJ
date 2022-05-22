<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Gudang;
use Illuminate\Http\Request;
use App\Models\Admin\User;


class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gudangs = Gudang::select('gudang.gudang_id', 'gudang.slug', 'u.username', 'u.name', 'gudang.alamat_gudang')
            ->join('users as u', 'gudang.user_id', '=', 'u.user_id')
            ->get();

        return view('admin.pages.gudang.index', compact('gudangs'));
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
    public function edit($slug)
    {
        $gudangs = Gudang::where('slug', $slug)->first();
        $user_id = $gudangs->user_id;
        $users = User::where('user_id', $user_id)->first();

        return view('admin.pages.gudang.edit', compact('gudangs', 'users'));
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
        $gudangs = Gudang::where('slug', $slug)->first();
        $user_id = $gudangs->user_id;
        $users = User::where('user_id', $user_id)->first();
        $cek_name = User::where('name', $request->get('nama_gudang'))
            ->where('name', '<>', $users->name)->count();
        if ($cek_name == 0) {
            $cek_username = User::where('username', $request->get('username_gudang'))
                ->where('username', '<>', $users->username)->count();
            if ($cek_username == 0) {
                $gudangs = Gudang::where('slug', $slug)->first();
                $user_id = $gudangs->user_id;
                $users = User::where('user_id', $user_id)->first();

                $users->name = $request->get('nama_gudang');
                $users->username = $request->get('username_gudang');
                $users->save();

                $gudangs->alamat_gudang = $request->get('alamat_gudang');
                $gudangs->save();
                return redirect('gudang')->with("success", "Data gudang berhasil diubah");
            } else {
                return redirect('/gudang/edit/' . $slug)->with("warning", "Data gudang dengan username tersebut sudah ada/sudah pernah dipakai");
            }
        } else {
            return redirect('/gudang/edit/' . $slug)->with("warning", "Data gudang dengan nama tersebut sudah ada/sudah pernah dipakai");
        }
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
