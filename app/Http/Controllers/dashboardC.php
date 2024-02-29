<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\logM;
use App\Models\produkM;
use App\Models\transaksiM;
use App\Models\User;
use Carbon\Carbon;

class dashboardC extends Controller
{
    public function index()
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Dashboard'
        ]);
        $totaluser = User::count();
        $totalproduk = produkM::count();
        $totaltransaksi = transaksiM::count();
        // $totaluangbayar = DB::table('transactions')
        //     ->sum('uang_bayar');
        $totalUangBayar = DB::table('transactions')
                    ->sum('uang_bayar');

        $totalUangKembali = DB::table('transactions')
                    ->sum('uang_kembali');

        $income = $totalUangBayar - $totalUangKembali;
        $subtitle = "Dashboard";
        $transaksi = transaksiM::select('id', 'created_at')->get()->groupBy(function($transaksi){
            Carbon::parse($transaksi->created_at)->format('M');
        });
        $months=[];
        $monthCount=[];
        foreach($transaksi as $month => $values){
            $months[]=$month;
            $monthCount[]=count($values);
        }
        return view('dashboard', compact('logM','totaluser','totaltransaksi','totalproduk', 'transaksi', 'months', 'monthCount', 'subtitle','income'));
    }
    
}
