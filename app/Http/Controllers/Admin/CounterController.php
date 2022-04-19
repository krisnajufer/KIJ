<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Counter;
use App\Models\Admin\User;
use App\Models\Auth\UserAuth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counters = Counter::select('counter.counter_id', 'counter.slug', 'u.name', 'counter.alamat_counter', 'u.username')
            ->join('users as u', 'counter.user_id', '=', 'u.user_id')
            ->get();

        return view('admin.pages.counter.index', compact('counters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = Counter::kode();

        return view('admin.pages.counter.tambah', compact('kode'));
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
            'id_counter' => 'required',
            'nama_counter' => 'required',
            'alamat_counter' => 'required',
            'username_counter' => 'required',
        ]);

        $cek_name = User::where('name', $request->nama_counter)->count();
        if ($cek_name == 0) {
            $cek_username = User::where('username', $request->username_counter)->count();
            if ($cek_username == 0) {
                $user_id = UserAuth::kode();
                $counters = new Counter;
                $users = new User;

                $users->user_id = $user_id;
                $users->slug = Str::random(16);
                $users->name = $request->nama_counter;
                $users->role = 'counter';
                $users->username = $request->username_counter;
                $users->password = 'counter';
                $users->save();

                $counters->counter_id = $request->id_counter;
                $counters->slug = Str::random(16);
                $counters->user_id = $user_id;
                $counters->alamat_counter = $request->alamat_counter;
                $counters->save();

                return redirect('counter')->with("success", "Data counter berhasil ditambahkan");
            } else {
                return back()->with("warning", "Data counter dengan username tersebut sudah ada !!");
            }
        } else {
            return back()->with("warning", "Data counter dengan nama tersebut sudah ada !!");
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $counters = Counter::where('slug', $slug)->first();
        $user_id = $counters->user_id;
        $users = User::where('user_id', $user_id)->first();

        return view('admin.pages.counter.edit', compact('counters', 'users'));
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
        $counters = Counter::where('slug', $slug)->first();
        $user_id = $counters->user_id;
        $users = User::where('user_id', $user_id)->first();
        $cek_name = User::where('name', $request->get('nama_counter'))
            ->where('name', '<>', $users->name)->count();
        if ($cek_name == 0) {
            $cek_username = User::where('username', $request->get('username_counter'))
                ->where('username', '<>', $users->username)->count();
            if ($cek_username == 0) {
                $counters = Counter::where('slug', $slug)->first();
                $user_id = $counters->user_id;
                $users = User::where('user_id', $user_id)->first();

                $users->name = $request->get('nama_counter');
                $users->username = $request->get('username_counter');
                $users->save();

                $counters->alamat_counter = $request->get('alamat_counter');
                $counters->save();
                return redirect('counter')->with("success", "Data counter berhasil diubah");
            } else {
                return redirect('/counter/edit/' . $slug)->with("warning", "Data counter dengan username tersebut sudah ada / sudah pernah dipakai !!");
            }
        } else {
            return redirect('/counter/edit/' . $slug)->with("warning", "Data counter dengan nama tersebut sudah ada / sudah pernah dipakai !!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $counter = Counter::where('slug', $request->slug)->first();

        $user_id = $counter->user_id;
        User::where('user_id', $user_id)->delete();

        session()->flash("info", "Data counter berhasil dihapus !!");
        return redirect::to('counter');
    }
}
