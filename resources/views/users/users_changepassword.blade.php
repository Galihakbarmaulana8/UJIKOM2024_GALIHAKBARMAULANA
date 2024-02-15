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
                                <h2>Edit Password User</h2>
                            </div>
                            <div class="x_content">
                                <br />
                                <form  action="{{ route('users.change', $user->id) }}" method="POST" class="form-horizontal form-label-left">
                                    @csrf
                                    @method('put')
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 ">Username</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input name="username" type="text" class="form-control col-md-7 col-md-7" value="{{$user->username}}" readonly>
                                            @error('username')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 ">Role</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input name="role" type="text" class="form-control col-md-7 col-md-7" value="{{$user->role}}" readonly>
                                            @error('role')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 ">New Password</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input name="new_password" type="password" class="form-control col-md-7 col-md-7" placeholder="New Password">
                                            @error('new_password')
                                            <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 ">Ulangi Password</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input name="password_confirm" type="password" class="form-control col-md-7 col-md-7" placeholder="Ulangi Password">
                                            @error('password_confirm')
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