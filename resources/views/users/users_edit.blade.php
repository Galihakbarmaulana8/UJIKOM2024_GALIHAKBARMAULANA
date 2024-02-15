@extends('admin')
@section('content')

<body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="x_panel">
                <div class="card-body">
                    <div class="col-md-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Edit Data User</h2>
                            </div>
                            <div class="x_content">
                                <br />
                                <form  action="{{ route('users.update', $user->id) }}" method="POST" class="form-horizontal form-label-left">
                                    @csrf
                                    @method('put')
                                    <div class="form-group row ">
                                        <label class="control-label col-md-3 col-sm-3 ">Nama</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input name="nama" type="text" class="form-control col-md-7 col-md-7" value="{{$user->nama}}">
                                            @error('nama')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 ">Username</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input name="username" type="text" class="form-control col-md-7 col-md-7" value="{{$user->username}}">
                                            @error('username')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 ">Role</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <select name="role" class="form-control col-md-3 col-md-3">
                                                <option>Pilih Role</option>
                                                @if($user->role == 'admin')
                                                <option value="admin"selected>Admin</option>
                                                <option value="kasir">Kasir</option>
                                                <option value="owner">Owner</option>
                                                @endif
                                                @if($user->role == 'kasir')
                                                <option value="admin">Admin</option>
                                                <option value="kasir"selected>Kasir</option>
                                                <option value="owner">Owner</option>
                                                @endif
                                                @if($user->role == 'owner')
                                                <option value="admin">Admin</option>
                                                <option value="kasir">Kasir</option>
                                                <option value="owner"selected>Owner</option>
                                                @endif
                                            </select>
                                            @error('role')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9  offset-md-3">
                                            <a href="{{ route('users.index')}}"type="button" class="btn btn-primary">Cancel</a>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection