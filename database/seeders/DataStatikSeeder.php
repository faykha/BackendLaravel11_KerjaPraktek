<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataStatik;

class DataStatikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DataStatik::create([
            'type_unit' => 'C',
            'LEBAR_BIDANG_static' => 2000,
            'TINGGI_BALOK_A_static' => 2400,
            'TINGGI_BALOK_B_static' => 2400,
            'TINGGI_CEILING_A_static' => 2400,
            'TINGGI_CEILING_B_static' => 2400,
            'TINGGI_CEILING_C_static' => 2400,
            'Siku_Dinding_base_static' => 90,
            'Siku_Dinding_wall_static' => 90,
            'Sudut_Lantai_x_Dinding_static' => 90,
            'TITIK_KRAN_AIR_L_static' => 1595,
            'TITIK_KRAN_AIR_T_static' => 950,
            'TITIK_DISPOSAL_PIPE_static' => 500,
            'LEBAR_MINIMAL_MCB_static' => 650,
            'LEBAR_MAXIMAL_MCB_static' => 1470,
            'TINGGI_MCB_static' => 640,
        ]);
    }
}

