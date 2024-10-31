<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserStaff;

class FlutterAuthController extends Controller
{
    // Fungsi untuk proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            $user = Auth::user(); // Mendapatkan user yang login
            
            // Mengembalikan respons sukses
            return response()->json([
                'message' => 'Login berhasil',
                'user' => [
                    'username' => $user->username,
                    'role' => $user->role,
                ],
            ], 200);
        }

        // Jika login gagal
        return response()->json(['message' => 'Username atau password salah.'], 401);
    }

    // Fungsi logout
    public function logout()
    {
        Auth::logout(); // Logout user
        return response()->json(['message' => 'Logout berhasil.'], 200);
    }
    
}
