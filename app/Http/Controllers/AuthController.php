<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Uploadcare;

class AuthController extends Controller
{
    function showLogin(){
        return view('pages.auth.index');
    }

    function loginProcess(Request $request){
        $data = $request->all();

        $response = Http::post('http://127.0.0.1:5000/auth/logindash', [
            "email"=> $data['email'],
            "password"=> $data['password'],
        ]);
    
    
        if ($response->successful()) {
            // Tangani jika berhasil membuat data baru
            return redirect('/')->with('success', 'Berhasil Login');
        } else {
            // Tangani jika terjadi kesalahan saat membuat data baru
            return redirect('/login')->with('danger', 'Gagal Login');
        }
    }

    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil Logout');
    }
}
