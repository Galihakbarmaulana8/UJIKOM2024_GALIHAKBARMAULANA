@extends('admin')
@section('content')

<body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="x_panel">
                <div class="card-body">
                <h4 class="card-title">Data Users</h4>
                <hr class="sidebar-divider d-none d-md-block">
                    @if($message = Session::get('success'))
                    <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <a href="{{ route('users.create') }}" type="button" class="btn btn-success">Tambah Data</a>
                    <a href="{{ url('users/pdf') }}" type="button" class="btn btn-warning">Cetak PDF</a>
                    <!-- Divider -->
                    <table id="datatable" class="table table-bordered table fixed" style="width:100%">
                        <thead>
                            <tr>
                                <th >No</th>
                                <th >Nama</th>
                                <th >Username</th>
                                <th >Role</th>
                                <th width="35%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $users)
                            <tr>
                                <td>{{ $users->id}}</td>
                                <td>{{ $users->nama}}</td>
                                <td>{{ $users->username}}</td>
                                <td>{{($users->role) }}</td>

                                <td>
                                    <form action="{{ route('users.destroy', $users->id) }}" method="POST">
                                        <a href="{{ route('users.edit', $users->id) }}" type="button" class="btn btn-sm btn-warning shadow">Edit</a>
                                        @csrf
                                        @method('delete')
                                        <a href="{{route('users.changepassword', $users->id)}}" class="btn btn-sm btn-primary shadow">Change Password</a>
                                        <button type="submit" class="btn btn-sm btn-danger shadow" onclick="return confirm('Konfirmasi Hapus Data !?');">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
@endsection
