<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserStaff; // Pastikan nama model Anda benar sesuai yang Anda buat

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login'); // Form login ada di resources/views/login.blade.php
    }

    // Fungsi untuk proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil user berdasarkan username
        $user = UserStaff::where('username', $request->input('username'))->first();

        // Cek jika user ditemukan, password cocok, dan role adalah 'admin'
        if ($user && Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            if ($user->role === 'admin') {
                // Redirect ke halaman dashboard jika login berhasil
                return redirect()->route('dashboard');
            } else {
                // Logout jika role bukan admin dan beri pesan error
                Auth::logout();
                return redirect()->route('login')->withErrors(['access' => 'Anda tidak memiliki akses ke halaman ini.']);
            }
        }

        // Jika login gagal
        return redirect()->route('login')->withErrors(['login' => 'Username atau password salah.']);
    }

    // Fungsi untuk menampilkan dashboard (halaman setelah login)
    public function dashboard()
    {
        return view('dashboard'); // Pastikan ada file dashboard di resources/views/dashboard.blade.php
    }

    // Fungsi logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
