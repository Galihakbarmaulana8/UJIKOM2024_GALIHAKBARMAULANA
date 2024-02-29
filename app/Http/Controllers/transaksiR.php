<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\transaksiM;
use App\Models\transaksiitemM;
use App\Models\produkM;
use App\Models\logM;
use PDF;

class transaksiR extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Daftar Transaksi'
        ]);
        $subtitle = "Data Transaksi";
        $transaksi = transaksiM::select()->orderBy('transactions.created_at', 'desc')->get();
        return view('transaksi/transaksi_index', compact('transaksi', 'subtitle'));

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
            'activity' => 'User Melihat Halaman Tambah Transaksi'
        ]);
        $subtitle = "Tambah Data Transaksi";
        // Mengelompokkan produk berdasarkan kategori
        $produk_by_kategori = produkM::orderBy('products.kategori')->get();
        $produk = produkM::all();
        return view('transaksi/transaksi_create', compact('produk', 'subtitle', 'produk_by_kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'uang_bayar' => 'required',
        ]);
        $total_harga = $request->get('total_harga');
        $transaksi = new transaksiM();
        $transaksi->fill([
            'id_user' => Auth::id(),
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'uang_bayar' => $request->input('uang_bayar'),
            'uang_kembali' => $request->input('uang_bayar') - $total_harga ,
            'total_harga' => $request->get('total_harga')
        ]);
        $transaksi->save();
        $no_produk = 0;

        foreach ($request->get('id_produk') as $id_produk) {
            $produk = produkM::findOrfail($id_produk);
            $transaksiitem = new transaksiitemM();
            $quantity = $request->get('quantity')[$no_produk];
            $transaksiitem->fill([
                "id_transaksi" => $transaksi->id,
                "id_produk" => $id_produk,
                "nama_produk" => $produk->nama_produk,
                "harga_produk" => $produk->harga_produk,
                "quantity" => $request->get('quantity')[$no_produk],
                "stok" => $produk->stok - $quantity  // Update the stock directly on the product model
            ]);
            $produk->stok -= $quantity;  // Deduct the quantity from the product's stock
            $produk->save();
            $transaksiitem->save();
            $no_produk++;
        }
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menambah Transaksi Baru: ' . 'Nama Pelanggan: ' . $transaksi->nama_pelanggan . ', ID Transaksi: ' . $transaksi->id_transaksi
            // 'activity' => 'User Melakukan Tambah Transaksi'
        ]);
        return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil Ditambah');
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
    public function edit($id)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Edit Transaksi'
        ]);
        $subtitle = "Edit Data Transaksi";
        // Retrieve the transaction you want to edit
        $transaksi = transaksiM::findOrFail($id);
        // Retrieve additional data if needed
        $produk = produkM::all(); // Example: Retrieve all products
        
        // Ambil produk yang sudah ditambahkan sebelumnya ke dalam transaksi
        $produkTerpilih = $transaksi->items->pluck('id_produk')->toArray();
        // Retrieve transaction items related to the transaction
        $transaksiitem = transaksiitemM::where('id_transaksi', $transaksi->id)->get();
        return view('transaksi/transaksi_edit', compact('transaksi', 'produk', 'transaksiitem', 'subtitle', 'produkTerpilih'));
        
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
    // Validate the incoming request data
    $request->validate([
        'nama_pelanggan' => 'required|string|max:255', // Nama pelanggan harus diisi, berupa string, maksimal 255 karakter
        'uang_bayar' => 'required|numeric|min:0', // Uang bayar harus diisi, berupa angka, minimal 0
        'id_produk.*' => 'exists:products,id_produk', // ID produk harus ada di dalam tabel produk
        'quantity.*' => 'integer|min:1', // Kuantitas produk harus berupa bilangan bulat positif
    ]);

     // Find the transaction by ID or throw a 404 error if not found
    $transaksi = transaksiM::findOrFail($id);

    // Set the nama_pelanggan field of the transaction to the value from the request
    $transaksi->nama_pelanggan = $request->nama_pelanggan;

    // Set the uang_bayar field of the transaction to the value from the request
    $transaksi->uang_bayar = $request->uang_bayar;
    
    // Get the existing transaction items
    $transaksiItems = $transaksi->items;
    // Mengembalikan stok produk yang sebelumnya dibeli
    foreach ($transaksiItems as $item) {
        $produk = ProdukM::find($item->id_produk);
        $produk->stok += $item->quantity;
        $produk->save();
    }

    // Initialize total transaction price
    $totalHarga = 0;

    // Update existing transaction items and add new items from the request
    foreach ($request->id_produk as $index => $newProdukId) {
        // Find the existing transaction item with the same product ID
        $existingItem = $transaksiItems->where('id_produk', $newProdukId)->first();

        // Get the requested quantity for the current product
        $requestedQuantity = $request->quantity[$index];

        // Check if the requested quantity exceeds the available stock
        $availableStock = ProdukM::find($newProdukId)->stok;
        if ($requestedQuantity > $availableStock) {
            // If the requested quantity exceeds the available stock, return an error response
            return redirect()->back()->withErrors(['quantity' => 'Stok produk "' . ProdukM::find($newProdukId)->nama_produk . '" tidak mencukupi.']);
        }

        // If the item exists, update its quantity
        if ($existingItem) {
            $existingItem->quantity = $requestedQuantity;
            $existingItem->save();
        } else {
            // Create a new transaction item for the new product
            $newItem = new transaksiItemM();
            $newItem->id_produk = $newProdukId;
            $newItem->quantity = $requestedQuantity;
            $newItem->harga_produk = ProdukM::find($newProdukId)->harga_produk;
            $newItem->nama_produk = ProdukM::find($newProdukId)->nama_produk;
            $transaksi->items()->save($newItem);
        }

        // Update stock for the current product
        $produk = ProdukM::find($newProdukId);
        $produk->stok -= $requestedQuantity;
        $produk->save();

        // Update total transaction price
        $totalHarga += $newItem->harga_produk * $requestedQuantity;
    }

    // Remove items that are not in the updated request
    $transaksi->items()->whereNotIn('id_produk', $request->id_produk)->delete();

    // Update the total transaction price
    $transaksi->total_harga = $totalHarga;

    // Calculate the change (uang kembali)
    $uangKembali = $request->uang_bayar - $totalHarga;
    $transaksi->uang_kembali = $uangKembali;

    // Save the changes to the transaction model
    $transaksi->save();

    // Redirect to the appropriate page after successful update
    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate');
}

//     public function update(Request $request, $id)
// {
//     // Validate the incoming request data
//     $request->validate([
//         'nama_pelanggan' => 'required|string|max:255', // Nama pelanggan harus diisi, berupa string, maksimal 255 karakter
//         'uang_bayar' => 'required|numeric|min:0', // Uang bayar harus diisi, berupa angka, minimal 0
//         'id_produk.*' => 'exists:products,id_produk', // ID produk harus ada di dalam tabel produk
//         'quantity.*' => 'integer|min:1', // Kuantitas produk harus berupa bilangan bulat positif
//     ]);

//     // Find the transaction by ID or throw a 404 error if not found
//     $transaksi = transaksiM::findOrFail($id);

//     // Set the nama_pelanggan field of the transaction to the value from the request
//     $transaksi->nama_pelanggan = $request->nama_pelanggan;

//     // Set the uang_bayar field of the transaction to the value from the request
//     $transaksi->uang_bayar = $request->uang_bayar;
    
//     // Get the existing transaction items
//     $transaksiItems = $transaksi->items;

//     // Initialize the total transaction price
//     $totalHarga = 0;

//     // Update existing transaction items and add new items from the request
//     foreach ($request->id_produk as $index => $newProdukId) {
//         // Find the existing transaction item with the same product ID
//         $existingItem = $transaksiItems->where('id_produk', $newProdukId)->first();
//          // Get the requested quantity for the current product
//     $requestedQuantity = $request->quantity[$index];

//     // Check if the requested quantity exceeds the available stock
//     $availableStock = ProdukM::find($newProdukId)->stok;
//     if ($requestedQuantity > $availableStock) {
//         // If the requested quantity exceeds the available stock, return an error response
//         return redirect()->back()->withErrors(['quantity' => 'Stok produk "' . ProdukM::find($newProdukId)->nama_produk . '" tidak mencukupi.']);
//     }
//         // If the item exists, update its quantity
//         if ($existingItem) {
//             $existingItem->quantity = $request->quantity[$index];
//             $existingItem->save();
//             $totalHarga += $existingItem->harga_produk * $existingItem->quantity;
//             // Update stock for the current product
//         $produk = ProdukM::find($newProdukId);
//         $produk->stok -= ($existingItem->quantity - $requestedQuantity);
//         $produk->save();
//         } else {
//             // Create a new transaction item for the new product
//             $newItem = new transaksiItemM();
//             $newItem->id_produk = $newProdukId;
//             $newItem->quantity = $request->quantity[$index];
//             $newItem->harga_produk = ProdukM::find($newProdukId)->harga_produk;
//             $newItem->nama_produk = ProdukM::find($newProdukId)->nama_produk;
//             $transaksi->items()->save($newItem);
//             $totalHarga += $newItem->harga_produk * $newItem->quantity;
//             // Update stock for the current product
//         $produk = ProdukM::find($newProdukId);
//         $produk->stok -= $newItem->quantity;
//         $produk->save();
//         }
//     }

//     // Remove items that are not in the updated request
//     $transaksi->items()->whereNotIn('id_produk', $request->id_produk)->delete();

//     // Update the total transaction price
//     $transaksi->total_harga = $totalHarga;

//     // Calculate the change (uang kembali)
//     $uangKembali = $request->uang_bayar - $totalHarga;
//     $transaksi->uang_kembali = $uangKembali;

//     // Save the changes to the transaction model
//     $transaksi->save();

//     // Redirect to the appropriate page after successful update
//     return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate');
// }
public function edit1($id)
{
    $logM = logM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Melihat Halaman Edit Transaksi'
    ]);
    $subtitle = "Edit Data Transaksi";
    $produk = produkM::all();
    $transaksi = transaksiM::findOrFail($id);
    $produkItem = $transaksi->items->pluck('id_produk')->toArray();
    // Retrieve transaction items related to the transaction
    $transaksiItems = transaksiitemM::where('id_transaksi', $transaksi->id)->get();
    // $transaksiItems = transaksiitemM::where('id_transaksi', $id)->get();
    return view('transaksi/transaksi_edit1', compact('produk', 'subtitle', 'transaksi', 'transaksiItems'));
}
// Fungsi untuk mengupdate data transaksi
public function update1(Request $request, $id)
{
    $logM = logM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Melakukan Edit Transaksi'
    ]);
    $total_harga = $request->get('total_harga');
    $transaksi = transaksiM::findOrFail($id);
    $transaksi->fill([
        'nama_pelanggan' => $request->input('nama_pelanggan'),
        'uang_bayar' => $request->input('uang_bayar'),
        'uang_kembali' => $request->input('uang_bayar') - $total_harga ,
        'total_harga' => $request->get('total_harga')
    ]);
    $transaksi->save();

    // Clear existing transaksi items
    transaksiitemM::where('id_transaksi', $id)->delete();

    $no_produk = 0;

    foreach ($request->get('id_produk') as $id_produk) {
        $produk = produkM::findOrfail($id_produk);
        $transaksiitem = new transaksiitemM();
        $quantity = $request->get('quantity')[$no_produk];
        $transaksiitem->fill([
            "id_transaksi" => $transaksi->id,
            "id_produk" => $id_produk,
            "nama_produk" => $produk->nama_produk,
            "harga_produk" => $produk->harga_produk,
            "quantity" => $request->get('quantity')[$no_produk],
            "stok" => $produk->stok - $quantity  // Update the stock directly on the product model
        ]);
        $produk->stok -= $quantity;  // Deduct the quantity from the product's stock
        $produk->save();
        $transaksiitem->save();
        $no_produk++;
    }

    return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil Diupdate');
}

    // public function update(Request $request, $id)
    // {
    //     $total_harga = $request->get('total_harga');
    //     $transaksi = new transaksiM();
    //     $transaksi->fill([
    //         'id_user' => Auth::id(),
    //         'nama_pelanggan' => $request->input('nama_pelanggan'),
    //         'uang_bayar' => $request->input('uang_bayar'),
    //         'uang_kembali' => $request->input('uang_bayar') - $total_harga ,
    //         'total_harga' => $request->get('total_harga')
    //     ]);
    //     $transaksi->save();
    //     $no_produk = 0;

    //     foreach ($request->get('id_produk') as $id_produk) {
    //         $produk = produkM::findOrfail($id_produk);
    //         $transaksiitem = new transaksiitemM();
    //         $quantity = $request->get('quantity')[$no_produk];
    //         $transaksiitem->fill([
    //             "id_transaksi" => $transaksi->id,
    //             "id_produk" => $id_produk,
    //             "nama_produk" => $produk->nama_produk,
    //             "harga_produk" => $produk->harga_produk,
    //             "quantity" => $request->get('quantity')[$no_produk],
    //             "stok" => $produk->stok - $quantity  // Update the stock directly on the product model
    //         ]);
    //         $produk->stok -= $quantity;  // Deduct the quantity from the product's stock
    //         $produk->save();
    //         $transaksiitem->save();
    //         $no_produk++;
    //     }

    //     return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil Diupdate');
    // }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = transaksiM::find($id);
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan');
        }

        $Log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Transaksi: ' . 'Nama Pelanggan: ' . $transaksi->nama_pelanggan . ', ID Transaksi: ' . $transaksi->id_transaksi
        ]);
        $transaksi->delete();
        // transaksiM::where('id', $id)->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil Dihapus');
    }
    public function pdf()
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak PDF Transaksi'
        ]);

        $transaksi = transaksiM::all();
        $pdf = PDF::loadview('/transaksi/transaksi_pdf', ['transaksi' => $transaksi]);
        return $pdf->stream('transaksi.pdf');
    }

    public function pdf2($id)
    {
        $logM = logM::create([
            'id_user'=> Auth::user()->id,
            'activity'=> 'User Mencetak Struk'
        ]);
        // Ambil data transaksi dan produk berdasarkan ID
        $transaksi = TransaksiM::select('transactions.*', 'products.*', 'transactions.id AS id')
        ->join('transaksiitem', 'transactions.id', '=', 'transaksiitem.id_transaksi')
        ->join('products', 'products.id_produk', '=', 'transaksiitem.id_produk')
        ->where('transactions.id', $id)
        ->first();

        if ($transaksi) {
            // Jika data ditemukan, buat PDF
            $pdf = PDF::loadView('transaksi/transaksi_struk', ['transaksi' => $transaksi]);
            return $pdf->stream('transaksi.struk' . $id . '.pdf');
        } else {
            // Jika data tidak ditemukan, Anda dapat mengembalikan respons yang sesuai, misalnya, halaman 404.
            return response('Data transaksi tidak ditemukan', 404);
        }
    }
    public function filter(Request $request)
    {
        $title = "Filter Transaksi";
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
    
        $transaksi = transaksiM::select('transactions.*', 'products.nama_produk', 'products.harga_produk')
            ->join('products', 'products.id', '=', 'transactions.id_produk')
            ->whereBetween('transactions.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('transactions.created_at', 'desc')
            ->get();
    
        return view('transaksi/transaksi_index', compact('title', 'transaksi', 'startDate', 'endDate'));
    }
}
