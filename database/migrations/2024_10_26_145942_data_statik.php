<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_statik', function (Blueprint $table) {
            $table->id();
            $table->string('type_unit');
            $table->float('LEBAR_BIDANG_static')->nullable();
            $table->float('TINGGI_BALOK_A_static')->nullable();
            $table->float('TINGGI_BALOK_B_static')->nullable();
            $table->float('TINGGI_CEILING_A_static')->nullable();
            $table->float('TINGGI_CEILING_B_static')->nullable();
            $table->float('TINGGI_CEILING_C_static')->nullable();
            $table->float('Siku_Dinding_base_static')->nullable();
            $table->float('Siku_Dinding_wall_static')->nullable();
            $table->float('Sudut_Lantai_x_Dinding_static')->nullable();
            $table->float('TITIK_KRAN_AIR_L_static')->nullable();
            $table->float('TITIK_KRAN_AIR_T_static')->nullable();
            $table->float('TITIK_DISPOSAL_PIPE_static')->nullable();
            $table->float('LEBAR_MINIMAL_MCB_static')->nullable();
            $table->float('LEBAR_MAXIMAL_MCB_static')->nullable();
            $table->float('TINGGI_MCB_static')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_statik');
    }
};
