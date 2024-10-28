<?php

namespace App\Http\Controllers;

use App\Models\UserStaff;
use Illuminate\Http\Request;

class UserStaffController extends Controller
{
    /**
     * Menampilkan semua data user staff.
     */
    public function index()
    {
        $users = UserStaff::all();
        return response()->json($users);
    }

    /**
     * Menyimpan data user staff baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user_staff',
            'password' => 'required|min:6',
        ]);

        $user = UserStaff::create([
            'username' => $request->username,
            'password' => bcrypt($request->password), // hash password
        ]);

        return response()->json([
            'message' => 'User staff berhasil ditambahkan',
            'data' => $user
        ], 201);
    }

    /**
     * Menampilkan data user staff berdasarkan kolom username.
     */
    public function show($username)
    {
        $user = UserStaff::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($user);
    }

    /**
     * Mengupdate data user staff berdasarkan kolom username.
     */
    public function update(Request $request, $username)
    {
        $request->validate([
            'username' => 'required|unique:user_staff,username,' . $username . ',username',
            'password' => 'nullable|min:6',
        ]);

        $user = UserStaff::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data = ['username' => $request->username];

        // Update password jika diisi
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return response()->json([
            'message' => 'User staff berhasil diperbarui',
            'data' => $user
        ]);
    }

    /**
     * Menghapus data user staff berdasarkan kolom username.
     */
    public function destroy($username)
    {
        $user = UserStaff::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User staff berhasil dihapus']);
    }
}