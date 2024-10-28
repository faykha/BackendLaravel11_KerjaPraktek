<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKitchen extends Model
{
    use HasFactory;

    protected $table = 'data_kitchen';

    protected $fillable = [
        'LEBAR_BIDANG',
        'TINGGI_BALOK_A',
        'TINGGI_BALOK_B',
        'TINGGI_CEILING_A',
        'TINGGI_CEILING_B',
        'TINGGI_CEILING_C',
        'Siku_Dinding_base',
        'Siku_Dinding_wall',
        'Sudut_Lantai_x_Dinding',
        'TITIK_KRAN_AIR_L',
        'TITIK_KRAN_AIR_T',
        'TITIK_DISPOSAL_PIPE',
        'TGL_ceklist',
        'foto',
        'LEBAR_MINIMAL_MCB',
        'LEBAR_MAXIMAL_MCB',
        'TINGGI_MCB',
        'unit_id',
        'is_problem',
        'problem_details',
    ];

    /**
     * Relasi ke tabel Unit.
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Relasi ke tabel Lantai melalui tabel Unit.
     */
    public function lantai()
    {
        return $this->hasOneThrough(TabelLantai::class, Unit::class, 'id', 'id', 'unit_id', 'lantai_id');
    }

    /**
     * Relasi ke tabel DataStatik berdasarkan tipe unit.
     */
    public function dataStatik()
    {
        return $this->belongsTo(DataStatik::class, 'type_unit', 'type_unit');
    }
}
