<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDataStatikColumnsToInteger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_statik', function (Blueprint $table) {
            $table->integer('LEBAR_BIDANG_static')->nullable()->change();
            $table->integer('TINGGI_BALOK_A_static')->nullable()->change();
            $table->integer('TINGGI_BALOK_B_static')->nullable()->change();
            $table->integer('TINGGI_CEILING_A_static')->nullable()->change();
            $table->integer('TINGGI_CEILING_B_static')->nullable()->change();
            $table->integer('TINGGI_CEILING_C_static')->nullable()->change();
            $table->integer('Siku_Dinding_base_static')->nullable()->change();
            $table->integer('Siku_Dinding_wall_static')->nullable()->change();
            $table->integer('Sudut_Lantai_x_Dinding_static')->nullable()->change();
            $table->integer('TITIK_KRAN_AIR_L_static')->nullable()->change();
            $table->integer('TITIK_KRAN_AIR_T_static')->nullable()->change();
            $table->integer('TITIK_DISPOSAL_PIPE_static')->nullable()->change();
            $table->integer('LEBAR_MINIMAL_MCB_static')->nullable()->change();
            $table->integer('LEBAR_MAXIMAL_MCB_static')->nullable()->change();
            $table->integer('TINGGI_MCB_static')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_statik', function (Blueprint $table) {
            $table->float('LEBAR_BIDANG_static')->nullable()->change();
            $table->float('TINGGI_BALOK_A_static')->nullable()->change();
            $table->float('TINGGI_BALOK_B_static')->nullable()->change();
            $table->float('TINGGI_CEILING_A_static')->nullable()->change();
            $table->float('TINGGI_CEILING_B_static')->nullable()->change();
            $table->float('TINGGI_CEILING_C_static')->nullable()->change();
            $table->float('Siku_Dinding_base_static')->nullable()->change();
            $table->float('Siku_Dinding_wall_static')->nullable()->change();
            $table->float('Sudut_Lantai_x_Dinding_static')->nullable()->change();
            $table->float('TITIK_KRAN_AIR_L_static')->nullable()->change();
            $table->float('TITIK_KRAN_AIR_T_static')->nullable()->change();
            $table->float('TITIK_DISPOSAL_PIPE_static')->nullable()->change();
            $table->float('LEBAR_MINIMAL_MCB_static')->nullable()->change();
            $table->float('LEBAR_MAXIMAL_MCB_static')->nullable()->change();
            $table->float('TINGGI_MCB_static')->nullable()->change();
        });
    }
}
