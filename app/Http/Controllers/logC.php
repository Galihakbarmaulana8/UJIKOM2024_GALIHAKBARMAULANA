<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\logM;

class logC extends Controller
{
    public function index(Request $request)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Log'
        ]);     

        $logM = LogM::select('users.*', 'log.*')->join('users', 'users.id', '=', 'log.id_user')->orderBy('log.created_at', 'desc')->get();

        $subtitle = "Daftar Aktivitas";
        return view('log', compact('logM', 'subtitle'));
    }
}
