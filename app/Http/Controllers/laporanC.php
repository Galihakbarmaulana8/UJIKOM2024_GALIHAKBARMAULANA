<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\transaksiM;
use App\Models\transaksiitemM;
use App\Models\produkM;
use App\Models\logM;
use Carbon\Carbon;
use PDF;

class laporanC extends Controller
{
    public function index(Request $transaksi)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Laporan'
        ]);
        $subtitle = "Laporan Transaksi";
        // $transaksi = transaksiM::select('transactions.*', 'products.nama_produk', 'products.harga_produk')
        //     ->join('products', 'products.id_produk', '=', 'transactions.id_transaksi')
        //     ->orderBy('transactions.created_at', 'desc')
        //     ->get();
            // $transaksi = TransaksiM::select('transactions.*', 'products.*', 'transactions.id AS id_transaksi')
            // ->join('transaksiitem', 'transactions.id', '=', 'transaksiitem.id_transaksi')
            // ->join('products', 'products.id_produk', '=', 'transaksiitem.id_produk')
            $transaksi = transaksiM::select()
            ->orderBy('transactions.created_at', 'desc')
            ->get();
    
        return view('transaksi/laporan', compact('subtitle', 'transaksi'));
    }
    public function filter(Request $request)
    {$logM = logM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Melihat Melakukan Filtering'
    ]);
        $subtitle = "Filter Transaksi";
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
    
        // $transaksi = TransaksiM::select('transactions.*', 'products.*', 'transactions.id AS id_transaksi')
        //     ->join('transaksiitem', 'transactions.id', '=', 'transaksiitem.id_transaksi')
        //     ->join('products', 'products.id_produk', '=', 'transaksiitem.id_produk')
        $transaksi = transaksiM::select()
            ->whereBetween('transactions.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('transactions.created_at', 'desc')
            ->get();
    
        return view('transaksi/laporan', compact('subtitle', 'transaksi', 'startDate', 'endDate'));
    }
    public function export(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
    
        $transaksi = transaksiM::select()
            ->whereBetween('transactions.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('transactions.created_at', 'desc')
            ->get();
    
        $pdf = PDF::loadView('transaksi/transaksi_pdf1', compact('transaksi', 'startDate', 'endDate'));
        return $pdf->stream(); 
    }
}
