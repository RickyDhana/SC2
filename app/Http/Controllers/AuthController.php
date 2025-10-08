<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user]);

            // Arahkan berdasarkan role
            switch ($user->role) {
                case 'vendor':
                    return redirect()->route('vendor.create');
                case 'verifikator1':
                    return redirect()->route('v1.index');
                case 'verifikator2':
                    return redirect()->route('v2.index');
                case 'verifikator3':
                    return redirect()->route('v3.index');
                case 'verifikator4':
                    return redirect()->route('v4.index');
                default:
                    return redirect()->route('login')->with('error', 'Role tidak dikenali.');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }
}
