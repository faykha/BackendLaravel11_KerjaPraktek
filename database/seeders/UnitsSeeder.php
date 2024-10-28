<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitsSeeder extends Seeder
{
    public function run()
    {
        // Looping untuk setiap lantai dari 1 hingga 30
        for ($lantai = 1; $lantai <= 30; $lantai++) {
            
            // Menambahkan unit A1 - A23 untuk setiap lantai
            for ($i = 1; $i <= 23; $i++) {
                Unit::create([
                    'nama_unit' => 'A' . $i,
                    'lantai' => $lantai,
                    'type_unit' => 'A', // Menambahkan type_unit sebagai 'A'
                ]);
            }

            // Menambahkan unit B1 - B10 untuk setiap lantai
            for ($i = 1; $i <= 10; $i++) {
                Unit::create([
                    'nama_unit' => 'B' . $i,
                    'lantai' => $lantai,
                    'type_unit' => 'B', // Menambahkan type_unit sebagai 'B'
                ]);
            }

            // Menambahkan unit C1 - C18 untuk setiap lantai
            for ($i = 1; $i <= 18; $i++) {
                Unit::create([
                    'nama_unit' => 'C' . $i,
                    'lantai' => $lantai,
                    'type_unit' => 'C', // Menambahkan type_unit sebagai 'C'
                ]);
            }
        }
    }
}
