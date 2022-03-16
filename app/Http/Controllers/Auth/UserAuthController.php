<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended('dashboard');
        } else {
            return redirect()->intended('login')->with('incorrect', 'Akun tidak ditemukan, periksa kembali username/password Anda');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('login');
    }
}
