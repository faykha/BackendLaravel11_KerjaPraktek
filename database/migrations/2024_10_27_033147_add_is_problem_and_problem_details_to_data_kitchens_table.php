<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsProblemAndProblemDetailsToDataKitchensTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('data_kitchen', function (Blueprint $table) {
            $table->boolean('is_problem')->default(false)->after('foto'); // Kolom status masalah
            $table->text('problem_details')->nullable()->after('is_problem'); // Kolom untuk deskripsi masalah
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('data_kitchen', function (Blueprint $table) {
            $table->dropColumn(['is_problem', 'problem_details']);
        });
    }
}
