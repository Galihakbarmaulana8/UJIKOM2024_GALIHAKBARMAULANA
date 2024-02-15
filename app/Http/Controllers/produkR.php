<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\produkM;
use App\Models\logM;
use PDF;

class produkR extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Daftar Produk'
        ]);
        $subtitle = "Daftar Produk";
        $produk = produkM::select()->orderBy('products.created_at', 'desc')->get();
        return view('produk/produk_index', compact('produk', 'subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Tambah Produk'
        ]);
        $subtitle = "Tambah Data Produk";
        $produk = produkM::all();
        return view('produk/produk_create', compact('produk','subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Tambah Produk'
        ]);
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'stok' => 'required',
            'kategori' => 'required',
        ]);

        produkM::create($request->post());
        return redirect()->route('produk.index')->with('success', 'Produk Berhasil Ditambah');
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
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Edit Produk'
        ]);
        $subtitle = "Halaman edit produk";
        $produk = produkM::find($id);
        return view('produk/produk_edit', compact('produk', 'subtitle'));
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
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Edit Produk'
        ]);
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'stok' => 'required',
            'kategori' => 'required',
        ]);
        $data = request()->except(['_token', '_method', 'submit']);

        produkM::where('id_produk',$id)->update($data);
        return redirect()->route('produk.index')->with('success', 'Produk Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Delete Produk'
        ]);
        produkM::where('id_produk',$id)->delete();
        return redirect()->route('produk.index')->with('success', 'Produk Berhasil Dihapus');
    }
    public function pdf(){
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengunduh PDF Produk'
        ]);
        $produk = produkM::all();
        $pdf = PDF::loadview('produk/produk_pdf', ['produk' => $produk]);
        return $pdf->stream('produk.pdf');
    }
}
