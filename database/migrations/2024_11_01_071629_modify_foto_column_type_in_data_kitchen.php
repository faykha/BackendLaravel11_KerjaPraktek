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
        Schema::table('data_kitchen', function (Blueprint $table) {
            // Ubah tipe kolom 'foto' dari binary menjadi string
            $table->string('foto')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_kitchen', function (Blueprint $table) {
            // Ubah kembali tipe kolom 'foto' menjadi binary
            $table->binary('foto')->nullable()->change();
        });
    }
};
