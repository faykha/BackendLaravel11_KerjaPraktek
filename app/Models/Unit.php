<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $fillable = [
        'nama_unit',
        'lantai',
        'type_unit' 
    ];

    // Relasi dengan tabel DataKitchen
    public function dataKitchen()
    {
        return $this->hasOne(DataKitchen::class);
    }

    // Relasi dengan tabel TabelLantai
    public function lantaiRelation()
    {
        return $this->belongsTo(TabelLantai::class, 'lantai');
    }
}
