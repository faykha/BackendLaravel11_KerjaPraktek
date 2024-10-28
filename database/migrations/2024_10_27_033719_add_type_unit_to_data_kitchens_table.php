<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeUnitToDataKitchensTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('data_kitchen', function (Blueprint $table) {
            $table->string('type_unit')->nullable()->after('unit_id'); // Menyimpan tipe unit
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('data_kitchen', function (Blueprint $table) {
            $table->dropColumn('type_unit');
        });
    }
}
