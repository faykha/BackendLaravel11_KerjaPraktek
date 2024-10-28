<?php

namespace App\Http\Controllers;

use App\Models\UserVendor;
use Illuminate\Http\Request;

class UserVendorController extends Controller
{
    /**
     * Menampilkan semua data user vendor.
     */
    public function index()
    {
        $vendors = UserVendor::all();
        return response()->json($vendors);
    }

    /**
     * Menyimpan data user vendor baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user_vendors',
            'password' => 'required|min:6',
        ]);

        $vendor = UserVendor::create([
            'username' => $request->username,
            'password' => bcrypt($request->password), // hash password
        ]);

        return response()->json([
            'message' => 'User vendor berhasil ditambahkan',
            'data' => $vendor
        ], 201);
    }

    /**
     * Menampilkan data user vendor berdasarkan kolom username.
     */
    public function show($username)
    {
        $vendor = UserVendor::where('username', $username)->first();

        if (!$vendor) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($vendor);
    }

    /**
     * Mengupdate data user vendor berdasarkan kolom username.
     */
    public function update(Request $request, $username)
    {
        $request->validate([
            'username' => 'required|unique:user_vendors,username,' . $username . ',username',
            'password' => 'nullable|min:6',
        ]);

        $vendor = UserVendor::where('username', $username)->first();

        if (!$vendor) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data = ['username' => $request->username];

        // Update password jika diisi
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $vendor->update($data);

        return response()->json([
            'message' => 'User vendor berhasil diperbarui',
            'data' => $vendor
        ]);
    }

    /**
     * Menghapus data user vendor berdasarkan kolom username.
     */
    public function destroy($username)
    {
        $vendor = UserVendor::where('username', $username)->first();

        if (!$vendor) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $vendor->delete();

        return response()->json(['message' => 'User vendor berhasil dihapus']);
    }
}
