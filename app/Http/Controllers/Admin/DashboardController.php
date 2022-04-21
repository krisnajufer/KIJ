<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TransaksiPenjualan;

class DashboardController extends Controller
{
    public function index()
    {
        // $earning_monthly = TransaksiPenjualan::max('grand_total_penjualan')->whereYear();
        return view('admin.pages.dashboard.index');
    }
}
