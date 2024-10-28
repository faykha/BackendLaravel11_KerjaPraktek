<?php

namespace App\Http\Controllers;

use App\Models\TabelLantai;
use Illuminate\Http\Request;

class TabelLantaiController extends Controller
{
    // Menampilkan semua data lantai
    public function index()
    {
        $lantai = TabelLantai::all();
        return response()->json($lantai);
    }

    // Menyimpan data lantai baru
    public function store(Request $request)
    {
        $request->validate([
            'lantai' => 'required',
        ]);

        $lantai = TabelLantai::create([
            'lantai' => $request->lantai,
        ]);

        return response()->json(['message' => 'Lantai berhasil ditambahkan', 'data' => $lantai], 201);
    }

    // Menampilkan data lantai berdasarkan kolom lantai
    public function show($lantai)
    {
        $result = TabelLantai::with('units')->where('lantai', $lantai)->first();

        if (!$result) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($result);
    }

    // Mengupdate data lantai berdasarkan kolom lantai
    public function update(Request $request, $lantai)
    {
        $request->validate([
            'lantai' => 'required',
        ]);

        $result = TabelLantai::where('lantai', $lantai)->first();

        if (!$result) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $result->update([
            'lantai' => $request->lantai,
        ]);

        return response()->json(['message' => 'Lantai berhasil diperbarui', 'data' => $result]);
    }

    // Menghapus data lantai berdasarkan kolom lantai
    public function destroy($lantai)
    {
        $result = TabelLantai::where('lantai', $lantai)->first();

        if (!$result) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $result->delete();

        return response()->json(['message' => 'Lantai berhasil dihapus']);
    }
}
