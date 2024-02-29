@extends('admin')
@section('content')
<body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="x_panel">
                <div class="card-body">
                    @if($message = Session::get('succes'))
                    <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <h4>Log Activity</h4>
                    <hr class="sidebar-divider d-none d-md-block">
                    <table id="datatable" class="table table-bordered table fixed" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Aktivitas</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no_produk = 1 ?>
                            @foreach ($logM as $log)
                            <tr>
                                <td>{{ $no_produk }}</td>
                                <td>{{ $log->nama }}</td>
                                <td>{{ $log->activity }}</td>
                                <td>{{ $log->created_at->toDayDateTimeString()  }}</td>
                            </tr>
                            <?php $no_produk++?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</body>
@endsection

