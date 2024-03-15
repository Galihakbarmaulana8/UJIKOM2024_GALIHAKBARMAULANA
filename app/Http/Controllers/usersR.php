<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\logM;
use PDF;

class usersR extends Controller
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
            'activity' => 'User Melihat Halaman Daftar User'
        ]);
        $subtitle = "Data Users";
        $user = User::select()->orderBy('users.created_at', 'desc')->get();
        return view('users/users_index', compact('user', 'subtitle'));
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
            'activity' => 'User Melihat Halaman Tambah User'
        ]);
        $subtitle = "Halaman Tambah Data User";
        $user = User::all();
        return view('users/users_create', compact('user', 'subtitle'));
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
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'role' => 'required',
        ]);

        $users = new User([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $users->save();
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User ' . Auth::user()->username . ' (' . Auth::user()->nama . ') Menambah User Baru: ' . $users->username . ' (' . $users->nama . ', Role: ' . $users->role . ')'
        ]);

        return redirect()->route('users.index')->with('success', 'User Berhasil Ditambah');
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
            'activity' => 'User Melihat Halaman Edit User'
        ]);
        $subtitle = "Halaman edit User";
        $user = User::find($id);
        return view('users/users_edit', compact('user', 'subtitle'));
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
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'role' => 'required',
        ]);

        $user = User::find($id);
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->role = $request->input('role');
        $user->update();
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User '. Auth::user()->username . ' (' . Auth::user()->nama . ') Mengedit User: ' . $user->username . ' (' . $user->nama . ', Role: ' . $user->role . ')'
        ]);
        return redirect()->route('users.index')->with('success', 'Data User Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User tidak ditemukan');
        }
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User ' . Auth::user()->username . ' (' . Auth::user()->nama . ') Menghapus User: ' . $user->username . ' (' . $user->nama . ', Role: ' . $user->role . ')'
            // 'activity' => 'User Menghapus Data User'
        ]);
        $user->delete();

        // User::where('id',$id)->delete();
        return redirect()->route('users.index')->with('success', 'User Berhasil Dihapus');
    }
    public function pdf()
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengunduh PDF User'
        ]);
        $user = User::all();
        $pdf = PDF::loadview('users/users_pdf', ['user' => $user]);
        return $pdf->stream('users.pdf');
    }

    public function changepassword($id)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Change Password'
        ]);
        $subtitle = "Halaman edit password User";
        $user = User::find($id);
        return view('users/users_changepassword', compact('user', 'subtitle'));
    }

    public function change(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required',
            'password_confirm' => 'required|same:new_password',
        ]);

        $user = User::where("id", $id)->first();
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User ' . Auth::user()->username . ' (' . Auth::user()->nama . ') Merubah password User: ' . $user->username . ' (' . $user->nama . ', Role: ' . $user->role . ')'
            // 'activity' => 'User Merubah Passowrd'
        ]);
        return redirect()->route('users.index')->with('success', 'Password Berhasil Diedit');
    }
}
