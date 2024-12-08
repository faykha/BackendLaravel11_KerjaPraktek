<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    // Menampilkan semua data unit
    public function index(Request $request)
    {
        $lantai = $request->query('lantai');
        
        // Jika ada parameter lantai, kita filter berdasarkan lantai
        if ($lantai) {
            $units = Unit::where('lantai', $lantai)->with('lantaiRelation')->get();
        } else {
            // Jika tidak ada filter lantai, tampilkan semua unit
            $units = Unit::with('lantaiRelation')->get();
        }

        return response()->json($units);
    }

    // Menyimpan data unit baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_unit' => 'required|unique:units,nama_unit',
            'lantai' => 'required|exists:tabel_lantai,id',
        ]);

        $unit = Unit::create([
            'nama_unit' => $request->nama_unit,
            'lantai' => $request->lantai,
        ]);

        return response()->json(['message' => 'Unit berhasil ditambahkan', 'data' => $unit], 201);
    }

    // Menampilkan data unit berdasarkan kolom nama_unit
    public function show($nama_unit)
    {
        $unit = Unit::with('lantaiRelation')->where('nama_unit', $nama_unit)->first();

        if (!$unit) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($unit);
    }

    // Mengupdate data unit berdasarkan kolom nama_unit
    public function update(Request $request, $nama_unit)
    {
        $request->validate([
            'nama_unit' => 'required',
            'lantai' => 'required|exists:tabel_lantai,id',
        ]);

        $unit = Unit::where('nama_unit', $nama_unit)->first();

        if (!$unit) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $unit->update([
            'nama_unit' => $request->nama_unit,
            'lantai' => $request->lantai,
        ]);

        return response()->json(['message' => 'Unit berhasil diperbarui', 'data' => $unit]);
    }

    // Menghapus data unit berdasarkan kolom nama_unit
    public function destroy($nama_unit)
    {
        $unit = Unit::where('nama_unit', $nama_unit)->first();

        if (!$unit) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $unit->delete();

        return response()->json(['message' => 'Unit berhasil dihapus']);
    }
}
