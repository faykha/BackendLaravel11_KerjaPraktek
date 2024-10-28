<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStatik extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'data_statik';

    // Kolom yang boleh diisi
    protected $fillable = [
        'type_unit',
        'LEBAR_BIDANG_static',
        'TINGGI_BALOK_A_static',
        'TINGGI_BALOK_B_static',
        'TINGGI_CEILING_A_static',
        'TINGGI_CEILING_B_static',
        'TINGGI_CEILING_C_static',
        'Siku_Dinding_base_static',
        'Siku_Dinding_wall_static',
        'Sudut_Lantai_x_Dinding_static',
        'TITIK_KRAN_AIR_L_static',
        'TITIK_KRAN_AIR_T_static',
        'TITIK_DISPOSAL_PIPE_static',
        'LEBAR_MINIMAL_MCB_static',
        'LEBAR_MAXIMAL_MCB_static',
        'TINGGI_MCB_static',
    ];
}
