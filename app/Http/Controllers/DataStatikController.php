<?php
namespace App\Http\Controllers;

use App\Models\DataStatik;
use Illuminate\Http\Request;

class DataStatikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataStatik = DataStatik::all();
        return response()->json($dataStatik);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'type_unit' => 'required|string|unique:data_statik,type_unit|max:255', // type_unit harus unik
            'LEBAR_BIDANG_static' => 'nullable|integer', // Kolom opsional, validasi integer jika ada
            'TINGGI_BALOK_A_static' => 'nullable|integer',
            'TINGGI_BALOK_B_static' => 'nullable|integer',
            'TINGGI_CEILING_A_static' => 'nullable|integer',
            'TINGGI_CEILING_B_static' => 'nullable|integer',
            'TINGGI_CEILING_C_static' => 'nullable|integer',
            'Siku_Dinding_base_static' => 'nullable|integer',
            'Siku_Dinding_wall_static' => 'nullable|integer',
            'Sudut_Lantai_x_Dinding_static' => 'nullable|integer',
            'TITIK_KRAN_AIR_L_static' => 'nullable|integer',
            'TITIK_KRAN_AIR_T_static' => 'nullable|integer',
            'TITIK_DISPOSAL_PIPE_static' => 'nullable|integer',
            'LEBAR_MINIMAL_MCB_static' => 'nullable|integer',
            'LEBAR_MAXIMAL_MCB_static' => 'nullable|integer',
            'TINGGI_MCB_static' => 'nullable|integer',
        ]);
    
        try {
            // Simpan data ke dalam database
            $dataStatik = DataStatik::create($validated);
    
            // Mengembalikan response jika berhasil
            return response()->json([
                'message' => 'Data statik berhasil disimpan.',
                'data' => $dataStatik
            ], 201); // 201 Created
        } catch (\Exception $e) {
            // Menangani error jika ada yang gagal
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Display the specified resource by type_unit.
     *
     * @param  string  $type_unit
     * @return \Illuminate\Http\Response
     */
    public function showByTypeUnit($type_unit)
    {
        $dataStatik = DataStatik::where('type_unit', $type_unit)->firstOrFail();
        return response()->json($dataStatik);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $type_unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type_unit)
    {
        $dataStatik = DataStatik::where('type_unit', $type_unit)->firstOrFail();

        $validated = $request->validate([
            'LEBAR_BIDANG_static' => 'nullable|integer',
            'TINGGI_BALOK_A_static' => 'nullable|integer',
            'TINGGI_BALOK_B_static' => 'nullable|integer',
            'TINGGI_CEILING_A_static' => 'nullable|integer',
            'TINGGI_CEILING_B_static' => 'nullable|integer',
            'TINGGI_CEILING_C_static' => 'nullable|integer',
            'Siku_Dinding_base_static' => 'nullable|integer',
            'Siku_Dinding_wall_static' => 'nullable|integer',
            'Sudut_Lantai_x_Dinding_static' => 'nullable|integer',
            'TITIK_KRAN_AIR_L_static' => 'nullable|integer',
            'TITIK_KRAN_AIR_T_static' => 'nullable|integer',
            'TITIK_DISPOSAL_PIPE_static' => 'nullable|integer',
            'LEBAR_MINIMAL_MCB_static' => 'nullable|integer',
            'LEBAR_MAXIMAL_MCB_static' => 'nullable|integer',
            'TINGGI_MCB_static' => 'nullable|integer',
        ]);

        $dataStatik->update($validated);
        return response()->json($dataStatik);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $type_unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($type_unit)
    {
        $dataStatik = DataStatik::where('type_unit', $type_unit)->firstOrFail();
        $dataStatik->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
