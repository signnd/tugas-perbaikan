<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PerbaikanController;

class AuthController extends Controller
{
    public function login () {
        if ($user = Auth::user()) {
            if ($user->role == 'admin') {
                $user_info = [
                    'name' => 'Administrator',
                ];
                return redirect()->intended('admin');
            } elseif ($user->role == 'pegawai') {
                $user_info = [
                    'name' => 'Pegawai',
                ];
                return redirect()->intended('pegawai');
            }
        }
        return view('auth.login');
    }

    public function authlogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if (Auth::attempt($credentials)) {
            //$request->session()->regenerate();
            $user = Auth::user();
            //$user['token'] = $user->createToken('mobile')->plainTextToken;
            if ($user->role == 'admin') {
                return redirect()->action([PerbaikanController::class, 'dashadmin']);
            } elseif ($user->role == 'pegawai') {
                return redirect()->action([PerbaikanController::class, 'dashpegawai']);
            }
            return redirect()->action([AuthController::class, 'login']);
        }
        return redirect('login')->withInput()->with('error', 'Email dan password tidak sesuai.');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'Berhasil logout');
    }
}
