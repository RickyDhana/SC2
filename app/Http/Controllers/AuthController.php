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

            switch ($user->role) {
                case 'vendor':
                    return redirect()->route('vendor.create');

                //Jurubeli
                case 'Juru_Beli_1':
                    return redirect()->route('Jurubeli1_1.index');
                case 'Juru_Beli_2':
                    return redirect()->route('Jurubeli1_2.index');
                case 'Juru_Beli_3':
                    return redirect()->route('Jurubeli1_3.index');
                case 'Juru_Beli_4':
                    return redirect()->route('Jurubeli1_4.index');
                case 'Juru_Beli_5':
                    return redirect()->route('Jurubeli1_5.index');
                case 'Juru_Beli_6':
                    return redirect()->route('Jurubeli1_6.index');
                case 'Juru_Beli_7':
                    return redirect()->route('Jurubeli1_7.index');
                case 'Juru_Beli_8':
                    return redirect()->route('Jurubeli1_8.index');
                case 'Juru_Beli_9':
                    return redirect()->route('Jurubeli1_9.index');
                case 'Juru_Beli_10':
                    return redirect()->route('Jurubeli1_10.index');
                case 'Juru_Beli_11':
                    return redirect()->route('Jurubeli1_11.index');
                case 'Juru_Beli_12':
                    return redirect()->route('Jurubeli1_12.index');
                case 'Juru_Beli_13':
                    return redirect()->route('Jurubeli1_13.index');
                case 'Juru_Beli_14':
                    return redirect()->route('Jurubeli1_14.index');

                //Kepala Biro 
                case 'Kepala_Biro_1':
                    return redirect()->route('v1.index');
                case 'Kepala_Biro_2':
                    return redirect()->route('v2.index');
                case 'Kepala_Biro_3':
                    return redirect()->route('v3.index');

                //Kepala Departemen
                case 'Kepala_Departemen':
                    return redirect()->route('v4.index');

                //Kepala Divisi
                case 'Kepala_Divisi':
                    return redirect()->route('v5.index');

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