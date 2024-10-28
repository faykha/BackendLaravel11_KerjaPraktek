<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_kitchen', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci'; // Atau 'utf8mb4_general_ci'
            
            $table->id('id_data_kitchen'); // ID utama dengan AUTO_INCREMENT
            $table->unsignedBigInteger('unit_id'); // Foreign key untuk unit
            $table->integer('LEBAR_BIDANG')->nullable();
            $table->integer('TINGGI_BALOK_A')->nullable();
            $table->integer('TINGGI_BALOK_B')->nullable();
            $table->integer('TINGGI_CEILING_A')->nullable();
            $table->integer('TINGGI_CEILING_B')->nullable();
            $table->integer('TINGGI_CEILING_C')->nullable();
            $table->integer('Siku_Dinding_base')->nullable();
            $table->integer('Siku_Dinding_wall')->nullable();
            $table->integer('Sudut_Lantai_x_Dinding')->nullable();
            $table->integer('TITIK_KRAN_AIR_L')->nullable();
            $table->integer('TITIK_KRAN_AIR_T')->nullable();
            $table->integer('TITIK_DISPOSAL_PIPE')->nullable();
            $table->date('TGL_ceklist')->nullable();
            $table->binary('foto')->nullable(); // Untuk menyimpan gambar
            $table->integer('LEBAR_MINIMAL_MCB')->nullable();
            $table->integer('LEBAR_MAXIMAL_MCB')->nullable();
            $table->integer('TINGGI_MCB')->nullable();
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            // Menambahkan foreign key constraint untuk unit_id
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kitchen');
    }
};
