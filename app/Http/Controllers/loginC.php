<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\logM;

class loginC extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_action(Request $request)
    {
        
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $logM = logM::create([
                'id_user' => Auth::user()->id,
                'activity' => 'User Login'
            ]);

            $request->session()->put('logM', $logM);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'password' => 'Username Atau Password Salah',
        ]);
        
    }
    
    public function logout(Request $request)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Logout'
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
