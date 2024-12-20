<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserStaff extends Authenticatable
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'user_staff';

    // Kolom-kolom yang boleh diisi
    protected $fillable = [
        'username',
        'password',
        'role', 
    ];

    // Menyembunyikan kolom password saat model di-serialize
    protected $hidden = [
        'password',
    ];

    // Mengatur atribut password agar otomatis di-hash
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
