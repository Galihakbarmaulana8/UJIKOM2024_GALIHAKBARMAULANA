@extends('admin')
@section('content')

<body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="x_panel">               
                <div class="card-body">
                <h4 class="card-title">Laporan Transaksi</h4>
                <div>
                    
                    <br>
                    <form action="{{ route('laporan.filter') }}" method="GET" class="row" id="laporanForm">
                        <div class="form-group col-md-5">
                            <label for="startDate">Tanggal Awal:</label>
                            <input type="date" name="startDate" id="startDate" class="form-control" value="{{ request('startDate') }}">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="endDate">Sampai</label>
                            <input type="date" name="endDate" id="endDate" class="form-control" value="{{ request('endDate') }}">
                        </div>
                        <div class="form-group col-md-2">
                            <br>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" onclick="searchData()">Search</button>
                                <a href="{{ route('laporan.index') }}" class="btn btn-primary">Refresh</a>      
                            </div>
                        </div>
                        <div>
                            @if(request()->has('startDate') && request()->has('endDate'))
                                <a href="{{ route('laporan.export', ['startDate' => request('startDate'), 'endDate' => request('endDate')]) }}" class="btn btn-warning">
                                    <i class="mdi mdi-file-pdf"></i> Cetak PDF
                                </a>
                            @endif
                        </div>
                    </form>
                    <div class="d-flex justify-content-between align-items-center col-md-4">
                        <!-- ... (additional content if needed) ... -->
                    </div>
                    <br>
    
                    <table id="datatable" class="table table-bordered table fixed" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Kode Transaksi</th>
                                <th>Items</th>
                                <th>Total Harga</th>
                                <th>Uang Bayar</th>
                                <th>Uang Kembali</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no_transaksi = 1 ?>
                            @foreach ($transaksi as $transaksi)
                                <tr>
                                    <td>{{ $no_transaksi }}</td>
                                    <td>{{ $transaksi->nama_pelanggan }}</td>
                                    <td>{{ $transaksi->id }}</td>
                                    <td>
                                        <ol>
                                            @foreach ($transaksi->items as $item)
                                                <li>{{ $item->nama_produk }} - {{ $item->quantity }} - Rp.{{ number_format($item->quantity * $item->harga_produk) }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>Rp.{{ number_format($transaksi->total_harga) }}</td>
                                    <td>Rp.{{ number_format($transaksi->uang_bayar) }}</td>
                                    <td>Rp.{{ number_format($transaksi->uang_kembali) }}</td>
                                    <td>{{ $transaksi->created_at->toDayDateTimeString() }}</td>
                                </tr>
                            <?php $no_transaksi++?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            

            </div>
            </div>

        </div>
    </div>
</body>
<script>
    function searchData() {
        document.getElementById('laporanForm').submit();
    }
</script>

@endsection