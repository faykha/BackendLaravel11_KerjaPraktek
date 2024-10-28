<?php

namespace App\Http\Controllers;

use App\Models\UserAdmin;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    /**
     * Menampilkan semua data user admin.
     */
    public function index()
    {
        $admins = UserAdmin::all();
        return response()->json($admins);
    }

    /**
     * Menyimpan data user admin baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user_admins',
            'password' => 'required|min:6',
        ]);

        $admin = UserAdmin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password), // hash password
        ]);

        return response()->json([
            'message' => 'User admin berhasil ditambahkan',
            'data' => $admin
        ], 201);
    }

    /**
     * Menampilkan data user admin berdasarkan kolom username.
     */
    public function show($username)
    {
        $admin = UserAdmin::where('username', $username)->first();

        if (!$admin) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($admin);
    }

    /**
     * Mengupdate data user admin berdasarkan kolom username.
     */
    public function update(Request $request, $username)
    {
        $request->validate([
            'username' => 'required|unique:user_admins,username,' . $username . ',username',
            'password' => 'nullable|min:6',
        ]);

        $admin = UserAdmin::where('username', $username)->first();

        if (!$admin) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data = ['username' => $request->username];

        // Update password jika diisi
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $admin->update($data);

        return response()->json([
            'message' => 'User admin berhasil diperbarui',
            'data' => $admin
        ]);
    }

    /**
     * Menghapus data user admin berdasarkan kolom username.
     */
    public function destroy($username)
    {
        $admin = UserAdmin::where('username', $username)->first();

        if (!$admin) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $admin->delete();

        return response()->json(['message' => 'User admin berhasil dihapus']);
    }
}
