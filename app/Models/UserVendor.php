<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserVendor extends Authenticatable
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'user_vendors';

    // Kolom-kolom yang boleh diisi
    protected $fillable = [
        'username',
        'password',
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
