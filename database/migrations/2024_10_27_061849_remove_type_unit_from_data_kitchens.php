<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('data_kitchen', function (Blueprint $table) {
        $table->dropColumn('type_unit');
    });
}

public function down()
{
    Schema::table('data_kitchen', function (Blueprint $table) {
        $table->string('type_unit')->nullable();
    });
}

};
