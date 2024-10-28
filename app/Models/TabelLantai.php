<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelLantai extends Model
{
    use HasFactory;

    protected $table = 'tabel_lantai';

    protected $fillable = [
        'lantai',
    ];
    public function units()
    {
        return $this->hasMany(Unit::class, 'lantai');
    }

    public function lantaiRelation()
    {
        return $this->belongsTo(NamaModelLantai::class, 'lantai');
    }
}
