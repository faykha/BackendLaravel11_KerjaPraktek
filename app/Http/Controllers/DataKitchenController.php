<?php

namespace App\Http\Controllers;

use App\Models\DataKitchen;
use Illuminate\Http\Request;

class DataKitchenController extends Controller
{
    // Menampilkan semua data kitchen dengan unit dan lantai terkait
    public function index()
    {
        $dataKitchens = DataKitchen::with(['unit', 'unit.lantaiRelation'])->get();
        return response()->json($dataKitchens);
    }

    // Menyimpan data kitchen baru
    public function store(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'lantai' => 'required|integer',
            'unit' => 'required|string',
            'LEBAR_BIDANG' => 'required|integer',
            'TINGGI_BALOK_A' => 'required|integer',
            'TINGGI_BALOK_B' => 'required|integer',
            'TINGGI_CEILING_A' => 'required|integer',
            'TINGGI_CEILING_B' => 'required|integer',
            'TINGGI_CEILING_C' => 'required|integer',
            'Siku_Dinding_base' => 'required|integer',
            'Siku_Dinding_wall' => 'required|integer',
            'Sudut_Lantai_x_Dinding' => 'required|integer',
            'TITIK_KRAN_AIR_L' => 'required|integer',
            'TITIK_KRAN_AIR_T' => 'required|integer',
            'TITIK_DISPOSAL_PIPE' => 'required|integer',
            'LEBAR_MINIMAL_MCB' => 'required|integer',
            'LEBAR_MAXIMAL_MCB' => 'required|integer',
            'TINGGI_MCB' => 'required|integer',
        ]);


        $existingData = DataKitchen::whereHas('unit', function($query) use ($request) {
            $query->where('lantai', $request->input('lantai'))
                  ->where('nama_unit', $request->input('unit'));
        })->exists();
    
        if ($existingData) {
            return response()->json(['message' => 'Data kitchen dengan lantai dan unit ini sudah ada.'], 409); // HTTP 409 Conflict
        }
    
        // Ambil unit berdasarkan lantai dan nama unit
        $unit = \App\Models\Unit::where('lantai', $request->input('lantai'))
                                ->where('nama_unit', $request->input('unit'))
                                ->first();
    
        if (!$unit) {
            return response()->json(['message' => 'Unit tidak ditemukan'], 404);
        }
    
        // Ambil data ketentuan dari DataStatik berdasarkan type_unit
        $dataStatik = \App\Models\DataStatik::where('type_unit', $unit->type_unit)->first();
    
        if (!$dataStatik) {
            return response()->json(['message' => 'Ketentuan untuk tipe unit ini tidak ditemukan'], 404);
        }
    
        // Variable untuk menyimpan status masalah dan detail masalah
        $isProblem = false;
        $problemDetails = [];
    
        // Pengecekan setiap kolom dengan toleransi ±10
        if ($request->input('LEBAR_BIDANG') < ($dataStatik->LEBAR_BIDANG_static - 10) || $request->input('LEBAR_BIDANG') > ($dataStatik->LEBAR_BIDANG_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'LEBAR_BIDANG tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('TINGGI_BALOK_A') < ($dataStatik->TINGGI_BALOK_A_static - 10) || $request->input('TINGGI_BALOK_A') > ($dataStatik->TINGGI_BALOK_A_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'TINGGI_BALOK_A tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('TINGGI_BALOK_B') < ($dataStatik->TINGGI_BALOK_B_static - 10) || $request->input('TINGGI_BALOK_B') > ($dataStatik->TINGGI_BALOK_B_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'TINGGI_BALOK_B tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('TINGGI_CEILING_A') < ($dataStatik->TINGGI_CEILING_A_static - 10) || $request->input('TINGGI_CEILING_A') > ($dataStatik->TINGGI_CEILING_A_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'TINGGI_CEILING_A tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('TINGGI_CEILING_B') < ($dataStatik->TINGGI_CEILING_B_static - 10) || $request->input('TINGGI_CEILING_B') > ($dataStatik->TINGGI_CEILING_B_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'TINGGI_CEILING_B tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('TINGGI_CEILING_C') < ($dataStatik->TINGGI_CEILING_C_static - 10) || $request->input('TINGGI_CEILING_C') > ($dataStatik->TINGGI_CEILING_C_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'TINGGI_CEILING_C tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('Siku_Dinding_base') < ($dataStatik->Siku_Dinding_base_static - 10) || $request->input('Siku_Dinding_base') > ($dataStatik->Siku_Dinding_base_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'Siku_Dinding_base tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('Siku_Dinding_wall') < ($dataStatik->Siku_Dinding_wall_static - 10) || $request->input('Siku_Dinding_wall') > ($dataStatik->Siku_Dinding_wall_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'Siku_Dinding_wall tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('Sudut_Lantai_x_Dinding') < ($dataStatik->Sudut_Lantai_x_Dinding_static - 10) || $request->input('Sudut_Lantai_x_Dinding') > ($dataStatik->Sudut_Lantai_x_Dinding_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'Sudut_Lantai_x_Dinding tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('TITIK_KRAN_AIR_L') < ($dataStatik->TITIK_KRAN_AIR_L_static - 10) || $request->input('TITIK_KRAN_AIR_L') > ($dataStatik->TITIK_KRAN_AIR_L_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'TITIK_KRAN_AIR_L tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('TITIK_KRAN_AIR_T') < ($dataStatik->TITIK_KRAN_AIR_T_static - 10) || $request->input('TITIK_KRAN_AIR_T') > ($dataStatik->TITIK_KRAN_AIR_T_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'TITIK_KRAN_AIR_T tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('TITIK_DISPOSAL_PIPE') < ($dataStatik->TITIK_DISPOSAL_PIPE_static - 10) || $request->input('TITIK_DISPOSAL_PIPE') > ($dataStatik->TITIK_DISPOSAL_PIPE_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'TITIK_DISPOSAL_PIPE tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('LEBAR_MINIMAL_MCB') < ($dataStatik->LEBAR_MINIMAL_MCB_static - 10) || $request->input('LEBAR_MINIMAL_MCB') > ($dataStatik->LEBAR_MINIMAL_MCB_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'LEBAR_MINIMAL_MCB tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('LEBAR_MAXIMAL_MCB') < ($dataStatik->LEBAR_MAXIMAL_MCB_static - 10) || $request->input('LEBAR_MAXIMAL_MCB') > ($dataStatik->LEBAR_MAXIMAL_MCB_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'LEBAR_MAXIMAL_MCB tidak sesuai ketentuan ±10';
        }
    
        if ($request->input('TINGGI_MCB') < ($dataStatik->TINGGI_MCB_static - 10) || $request->input('TINGGI_MCB') > ($dataStatik->TINGGI_MCB_static + 10)) {
            $isProblem = true;
            $problemDetails[] = 'TINGGI_MCB tidak sesuai ketentuan ±10';
        }
    
        // Simpan gambar jika ada
        $path = $request->file('foto') ? $request->file('foto')->store('uploads') : null;
    
        // Simpan data kitchen dengan status is_problem dan problem_details
        $dataKitchen = DataKitchen::create(array_merge(
            $request->except(['lantai', 'unit', 'foto']),
            [
                'unit_id' => $unit->id,
                'foto' => $path,
                'is_problem' => $isProblem,
                'problem_details' => $isProblem ? implode('; ', $problemDetails) : null, // Menyimpan detail masalah sebagai teks
            ]
        ));
    
        return response()->json(['message' => 'Data berhasil disimpan.', 'data' => $dataKitchen], 201);
    }
    

    // Menampilkan data kitchen berdasarkan lantai dan unit
    public function showByLantaiAndUnit(Request $request)
    {
        $request->validate([
            'lantai' => 'required|integer',
            'unit' => 'required|string',
        ]);

        $dataKitchen = DataKitchen::whereHas('unit', function ($query) use ($request) {
            $query->where('lantai', $request->input('lantai'))
                  ->where('nama_unit', $request->input('unit'));
        })->with(['unit', 'unit.lantaiRelation'])->first();

        if (!$dataKitchen) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($dataKitchen);
    }

    // Mengupdate data kitchen berdasarkan lantai dan unit
    public function updateByLantaiAndUnit(Request $request)
{
    // Validasi input
    $request->validate([
        'lantai' => 'required|integer',
        'unit' => 'required|string',
        'LEBAR_BIDANG' => 'required|integer',
        'TINGGI_BALOK_A' => 'required|integer',
        'TINGGI_BALOK_B' => 'required|integer',
        'TINGGI_CEILING_A' => 'required|integer',
        'TINGGI_CEILING_B' => 'required|integer',
        'TINGGI_CEILING_C' => 'required|integer',
        'Siku_Dinding_base' => 'required|integer',
        'Siku_Dinding_wall' => 'required|integer',
        'Sudut_Lantai_x_Dinding' => 'required|integer',
        'TITIK_KRAN_AIR_L' => 'required|integer',
        'TITIK_KRAN_AIR_T' => 'required|integer',
        'TITIK_DISPOSAL_PIPE' => 'required|integer',
        'TGL_ceklist' => 'required|date',
        'foto' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        'LEBAR_MINIMAL_MCB' => 'required|integer',
        'LEBAR_MAXIMAL_MCB' => 'required|integer',
        'TINGGI_MCB' => 'required|integer',
    ]);

    // Cari data kitchen berdasarkan `lantai` dan `unit`
    $dataKitchen = DataKitchen::whereHas('unit', function ($query) use ($request) {
        $query->where('lantai', $request->input('lantai'))
              ->where('nama_unit', $request->input('unit'));
    })->first();

    // Jika data kitchen tidak ditemukan
    if (!$dataKitchen || !$dataKitchen->id_data_kitchen) {
        return response()->json(['message' => 'Data tidak ditemukan atau ID tidak valid'], 404);
    }
    // Ambil data statik yang sesuai dengan tipe unit
    $unit = $dataKitchen->unit;
    $dataStatik = \App\Models\DataStatik::where('type_unit', $unit->type_unit)->first();

    if (!$dataStatik) {
        return response()->json(['message' => 'Ketentuan untuk tipe unit ini tidak ditemukan'], 404);
    }

    // Inisialisasi pengecekan masalah
    $isProblem = false;
    $problemDetails = [];

    // Pengecekan setiap kolom dengan toleransi ±10
    if ($request->input('LEBAR_BIDANG') < ($dataStatik->LEBAR_BIDANG_static - 10) || $request->input('LEBAR_BIDANG') > ($dataStatik->LEBAR_BIDANG_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'LEBAR_BIDANG tidak sesuai ketentuan ±10';
    }
    if ($request->input('TINGGI_BALOK_A') < ($dataStatik->TINGGI_BALOK_A_static - 10) || $request->input('TINGGI_BALOK_A') > ($dataStatik->TINGGI_BALOK_A_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'TINGGI_BALOK_A tidak sesuai ketentuan ±10';
    }
    if ($request->input('TINGGI_BALOK_B') < ($dataStatik->TINGGI_BALOK_B_static - 10) || $request->input('TINGGI_BALOK_B') > ($dataStatik->TINGGI_BALOK_B_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'TINGGI_BALOK_B tidak sesuai ketentuan ±10';
    }
    if ($request->input('TINGGI_CEILING_A') < ($dataStatik->TINGGI_CEILING_A_static - 10) || $request->input('TINGGI_CEILING_A') > ($dataStatik->TINGGI_CEILING_A_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'TINGGI_CEILING_A tidak sesuai ketentuan ±10';
    }
    if ($request->input('TINGGI_CEILING_B') < ($dataStatik->TINGGI_CEILING_B_static - 10) || $request->input('TINGGI_CEILING_B') > ($dataStatik->TINGGI_CEILING_B_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'TINGGI_CEILING_B tidak sesuai ketentuan ±10';
    }
    if ($request->input('TINGGI_CEILING_C') < ($dataStatik->TINGGI_CEILING_C_static - 10) || $request->input('TINGGI_CEILING_C') > ($dataStatik->TINGGI_CEILING_C_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'TINGGI_CEILING_C tidak sesuai ketentuan ±10';
    }
    if ($request->input('Siku_Dinding_base') < ($dataStatik->Siku_Dinding_base_static - 10) || $request->input('Siku_Dinding_base') > ($dataStatik->Siku_Dinding_base_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'Siku_Dinding_base tidak sesuai ketentuan ±10';
    }
    if ($request->input('Siku_Dinding_wall') < ($dataStatik->Siku_Dinding_wall_static - 10) || $request->input('Siku_Dinding_wall') > ($dataStatik->Siku_Dinding_wall_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'Siku_Dinding_wall tidak sesuai ketentuan ±10';
    }
    if ($request->input('Sudut_Lantai_x_Dinding') < ($dataStatik->Sudut_Lantai_x_Dinding_static - 10) || $request->input('Sudut_Lantai_x_Dinding') > ($dataStatik->Sudut_Lantai_x_Dinding_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'Sudut_Lantai_x_Dinding tidak sesuai ketentuan ±10';
    }
    if ($request->input('TITIK_KRAN_AIR_L') < ($dataStatik->TITIK_KRAN_AIR_L_static - 10) || $request->input('TITIK_KRAN_AIR_L') > ($dataStatik->TITIK_KRAN_AIR_L_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'TITIK_KRAN_AIR_L tidak sesuai ketentuan ±10';
    }
    if ($request->input('TITIK_KRAN_AIR_T') < ($dataStatik->TITIK_KRAN_AIR_T_static - 10) || $request->input('TITIK_KRAN_AIR_T') > ($dataStatik->TITIK_KRAN_AIR_T_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'TITIK_KRAN_AIR_T tidak sesuai ketentuan ±10';
    }
    if ($request->input('TITIK_DISPOSAL_PIPE') < ($dataStatik->TITIK_DISPOSAL_PIPE_static - 10) || $request->input('TITIK_DISPOSAL_PIPE') > ($dataStatik->TITIK_DISPOSAL_PIPE_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'TITIK_DISPOSAL_PIPE tidak sesuai ketentuan ±10';
    }
    if ($request->input('LEBAR_MINIMAL_MCB') < ($dataStatik->LEBAR_MINIMAL_MCB_static - 10) || $request->input('LEBAR_MINIMAL_MCB') > ($dataStatik->LEBAR_MINIMAL_MCB_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'LEBAR_MINIMAL_MCB tidak sesuai ketentuan ±10';
    }
    if ($request->input('LEBAR_MAXIMAL_MCB') < ($dataStatik->LEBAR_MAXIMAL_MCB_static - 10) || $request->input('LEBAR_MAXIMAL_MCB') > ($dataStatik->LEBAR_MAXIMAL_MCB_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'LEBAR_MAXIMAL_MCB tidak sesuai ketentuan ±10';
    }
    if ($request->input('TINGGI_MCB') < ($dataStatik->TINGGI_MCB_static - 10) || $request->input('TINGGI_MCB') > ($dataStatik->TINGGI_MCB_static + 10)) {
        $isProblem = true;
        $problemDetails[] = 'TINGGI_MCB tidak sesuai ketentuan ±10';
    }

    // Jika ada file foto yang diunggah, perbarui file foto
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('uploads');
        $dataKitchen->foto = $path;
    }

    // Update data kitchen dengan status is_problem dan problem_details
    $dataKitchen->update(array_merge(
        $request->except(['id_data_kitchen', 'lantai', 'unit', 'foto']),
        [
            'is_problem' => $isProblem,
            'problem_details' => $isProblem ? implode('; ', $problemDetails) : null, // Menyimpan detail masalah sebagai teks
        ]
    ));

    return response()->json(['message' => 'Data berhasil diperbarui.', 'data' => $dataKitchen], 200);
}


    // Menghapus data kitchen berdasarkan lantai dan unit
    public function destroyByLantaiAndUnit(Request $request)
    {
        $request->validate([
            'lantai' => 'required|integer',
            'unit' => 'required|string',
        ]);

        $dataKitchen = DataKitchen::whereHas('unit', function ($query) use ($request) {
            $query->where('lantai', $request->input('lantai'))
                  ->where('nama_unit', $request->input('unit'));
        })->first();

        if (!$dataKitchen) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $dataKitchen->delete();

        return response()->json(['message' => 'Data berhasil dihapus.']);
    }

    public function getProblematicUnits()
    {
        // Ambil data kitchen yang memiliki masalah (is_problem = true)
        $problematicUnits = DataKitchen::where('is_problem', true)
            ->with(['unit', 'unit.lantaiRelation']) // Memuat relasi unit dan lantai
            ->get(['unit_id', 'problem_details']);

        // Transform data untuk memunculkan lantai, unit, dan detail masalah
        $problematicData = $problematicUnits->map(function ($dataKitchen) {
            return [
                'lantai' => $dataKitchen->unit->lantaiRelation->lantai ?? null, // Mengakses lantai dari relasi
                'unit' => $dataKitchen->unit->nama_unit,
                'problem_details' => $dataKitchen->problem_details
            ];
        });

        return response()->json([
            'message' => 'Daftar unit dan lantai yang bermasalah',
            'data' => $problematicData,
        ]);
    }

}